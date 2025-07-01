function loadData() {


$('#video').on('change', function (event) {
  var input = event.target;
  if (input.files && input.files[0]) {
    var file = input.files[0];
    // var fileSize = file.size / 1024 / 1024;

    // if (fileSize > 10) {
    //   alert('File size exceeds 10 MB. Please upload a smaller video.');
    //   $('#video').val('');
    //   $('#previewVideo').hide();
    //   return;
    // }

    var url = URL.createObjectURL(file);
    $('#previewVideo').attr('src', url).show();
  }
});


    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveSlider.php",
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
      "data": "image",
      "render": function(data, type, row, meta) {
        if(data){
          return '<video width="100" controls><source src="tulkadmin/'+data+'" type="video/mp4">Your browser does not support video.</video>';
        } else {
          return 'No Video';
        }
      }
    },
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `<a href="editSlider.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editSlider.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

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



$(function() {
  
  $("form[name='addformpage']").validate({
   
    rules: {        
     
      image          : "required",
     
    },

    messages: {         
     
      image          : "Please Upload the Image",
      
    },
    
    submitHandler: function(form) {
   
      
        let formdata = new FormData();
     
        
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){

          formdata.append(field.name, field.value);
        
          
        });
        formdata.append('action' , 'save'); 
         let video = $('#video')[0].files;

        if (video.length > 0){
          formdata.append('video', video[0]);
        }   
        $("#save").attr("disabled", true);
         $('#pageloader').show();
    

        $.ajax({
          type: "POST",
          url: "actions/saveSlider.php",
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
                location.href = "manageSlider.php";
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

           let video = $('#video')[0].files;

        if (video.length > 0){
          formdata.append('video', video[0]);
        }   
        $("#save").attr("disabled", true);
         $('#pageloader').show();
        
    
        $.ajax({
          type: "POST",
          url: "actions/saveSlider.php",
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
                location.href = "manageSlider.php";
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

  function RemoveAccount(id) {
  let check = confirm('Are You Sure You want To delete This Data..?');
  if(check) {
    $.ajax({
      url  : "actions/saveSlider.php",
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
