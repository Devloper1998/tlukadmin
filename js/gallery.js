function loadData() {


    $('#header_logo').on('change', function(event) {
  var input = event.target;
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result);
      $('#previewImage').show();
    }

    reader.readAsDataURL(input.files[0]);
  }
});

   
  
    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveGallery.php",
    type: 'post',
    data: { 'action': 'Display'},
  },
  "columns": [
    {
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    },
  
    {
      "data": "gallery_image",
      "render": function(data, type, row, meta) {
        if(data){
          return '<img src="tulk/'+data+'" alt="Event Image" style="width: 80px; height: auto; border-radius: 4px;" />';
        } else {
          return 'No Image';
        }
      }
    },
    
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `
                <a href="editGallery.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

                <a href="#" title="Delete" onclick="RemoveAccount(${oData.id})"><i class="fas fa-trash"></i></a>&nbsp;&nbsp; `;
                        $(nTd).html(bnTd);
                }
    }
  ],
  select: true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
  columnDefs: [
    { className: 'text-center', targets: [0, 5] },
  ],
  aoColumnDefs: [{ 'bSortable': false, 'aTargets': ['no-sort'] }],
  sPaginationType: 'full_numbers',
});

  }

  $(document).ready(function() {
    loadData();
  });

  function RemoveAccount(id) {
  let check = confirm('Are You Sure You want To delete This Data..?');
  if(check) {
    $.ajax({
      url  : "actions/saveGallery.php",
      type : "post",
      data : { id : id, 'action' : 'delete' },
      success: function(data) {
        if(data == 'true') {
          toastr.success('deleted successfully...!');
          loadData();
        }       
      }
    });
  }
  return false;
}


$(function() {
  
  $("form[name='addformpage']").validate({
   
    rules: {        
     
      header_logo          : "required",
      footer_logo          : "required",
     
    },

    messages: {         
     
      header_logo          : "Please Upload the Gallery Image",
      footer_logo          : "Please Upload the Footer Logo",
      
    },
    
    submitHandler: function(form) {
   
      
        let formdata = new FormData();
     
        
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){

          formdata.append(field.name, field.value);
        
          
        });
        formdata.append('action' , 'save'); 
         let header_logo = $('#header_logo')[0].files;

        if (header_logo.length > 0){
          formdata.append('header_logo', header_logo[0]);
        }   

         
        $("#save").attr("disabled", true);
         $('#pageloader').show();  
    

        $.ajax({
          type: "POST",
          url: "actions/saveGallery.php",
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: formdata,
          success: function (data) {
            if (data.trim() == 'true'){
              $('#pageloader').hide();
              $("#save").attr("disabled", false);
              toastr.success('Saved Successfully...!');
              setTimeout(function (){
                location.href = "manageGallery.php";
              },1000);
            }
            else{
              toastr.error(data);
            }
          }
        });
      }
  });
});


$(function() {
  
  $("form[name='editform']").validate({
   
    
    
    
    submitHandler: function(form) {
     // alert("hii");
      
        let formdata = new FormData();
      

      
        let x = $('#editform').serializeArray();
        $.each(x, function(i, field){
        
        formdata.append(field.name, field.value);
        
        });
        formdata.append('action' , 'update');

          let header_logo = $('#header_logo')[0].files;

        if (header_logo.length > 0){
          formdata.append('header_logo', header_logo[0]);
        }   

           
        $("#save").attr("disabled", true);
         $('#pageloader').show();
    
        $.ajax({
          type: "POST",
          url: "actions/saveGallery.php",
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: formdata,
          success: function (data) {
            if (data.trim() == 'true'){
              $('#pageloader').hide();
              $("#save").attr("disabled", false);
              toastr.success('Updated Successfully...!');
              setTimeout(function (){
                location.href = "manageGallery.php";
              },1000);
            }
            else{
              toastr.error(data);
            }
          }
        });
      }
  });
});

