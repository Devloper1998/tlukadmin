function loadData() {
  
    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveSocialIcons.php",
    type: 'post',
    data: { 'action': 'Display'},
  },
  "columns": [
    {
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    },
    { "data": "title" },
    { "data": "link" },
   
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `<a href="editSocialIcons.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editSocialIcons.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

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
      url  : "actions/saveSocialIcons.php",
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
      title          : "required",
      link          : "required",
     
    },

    messages: {         
      title          : "Please Enter Title Name",
      link          : "Please Enter Social Link Url",
    },
    
    submitHandler: function(form) {
   
      
        let formdata = new FormData();
     
        
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){

          formdata.append(field.name, field.value);
        
          
        });
        formdata.append('action' , 'save'); 
        $("#save").attr("disabled", true);
         $('#pageloader').show();
         
        $.ajax({
          type: "POST",
          url: "actions/saveSocialIcons.php",
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: formdata,
          success: function (data) {
            if (data.trim() == 'true'){
              toastr.success('Saved Successfully...!');
              $('#pageloader').hide();
             $("#save").attr("disabled", false);
              setTimeout(function (){
                location.href = "manageSocialicons.php";
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
   
     rules: {        
      event_name          : "required",
      date          : "required",
      start_time          : "required",
      end_time          : "required",
      // main_image          : "required",
      description1          : "required",
      // image          : "required",
      description2          : "required",
     
    },

    messages: {         
      event_name          : "Please Enter Event Name",
      date          : "Please Enter Date",
      start_time          : "Please Enter Start Time",
      end_time          : "Please Enter End Time",
      // main_image          : "Please Upload the Main image",
      description1          : "Please Enter Description",
      // image          : "Please Upload the image",
      description2          : "Please Enter Description",
      
    },
    
    
    submitHandler: function(form) {
     // alert("hii");
      
        let formdata = new FormData();
        let x = $('#editform').serializeArray();
        $.each(x, function(i, field){
        
        formdata.append(field.name, field.value);
        
        });
        formdata.append('action' , 'update');
        $("#save").attr("disabled", true);
         $('#pageloader').show();
       
        $.ajax({
          type: "POST",
          url: "actions/saveSocialIcons.php",
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
                location.href = "manageSocialicons.php";
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

