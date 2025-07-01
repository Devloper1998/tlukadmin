let convertedBlobs = {
  main_image: null,
  image: null
};
function loadData() {

$('.image-upload').on('change', function (event) {
  const input = event.target;
  const previewSelector = $(this).data('preview');
  const file = input.files[0];
  const fieldId = input.id;

  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const img = new Image();
    img.onload = function () {
      let requiredWidth = 0;
      let requiredHeight = 0;

      if (fieldId === 'main_image') {
        requiredWidth = 800;
        requiredHeight = 600;
      } else if (fieldId === 'image') {
        requiredWidth = 1600;
        requiredHeight = 1200;
      }

      // if (img.width < requiredWidth || img.height < requiredHeight) {
      //   alert(`${fieldId.replace('_', ' ')} must be at least ${requiredWidth}×${requiredHeight} pixels.`);
      //   $(input).val('');
      //   $(previewSelector).hide();
      //   return;
      // }

      // Resize using canvas
      const canvas = document.createElement('canvas');
      canvas.width = requiredWidth;
      canvas.height = requiredHeight;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0, requiredWidth, requiredHeight);

      // Convert to webp
      canvas.toBlob(function (blob) {
        convertedBlobs[fieldId] = blob;

        const previewURL = URL.createObjectURL(blob);
        $(previewSelector).attr('src', previewURL).show();
      }, 'image/webp', 0.8);
    };
    img.src = e.target.result;
  };
  reader.readAsDataURL(file);
});

// $('.image-upload').on('change', function(event) {
//   var input = event.target;
//   var previewSelector = $(this).data('preview');
//   var file = input.files[0];

//   if (file) {
//     var img = new Image();
//     var objectUrl = URL.createObjectURL(file);

//     img.onload = function() {
//       var width = this.width;
//       var height = this.height;

//        // Mainimages Resize

//       if (input.id === 'main_image') {
//         if (width < 800  || height < 600 ) {
//           alert("Main Image must be at least 800×600 pixels.");
//           $(input).val('');
//           $(previewSelector).hide();
//           URL.revokeObjectURL(objectUrl);
//           return;
//         }
//       } 

//       // subimages Resize
//        if (input.id === 'image') {
//         if (width < 1600 || height < 1200) {
//           alert("Event Image1 must be at least 1600×1200 pixels.");
//           $(input).val('');
//           $(previewSelector).hide();
//           URL.revokeObjectURL(objectUrl);
//           return;
//         }
//       }

      
//       var reader = new FileReader();
//       reader.onload = function(e) {
//         $(previewSelector).attr('src', e.target.result).show();
//       }
//       reader.readAsDataURL(file);
//       URL.revokeObjectURL(objectUrl);
//     };

//     img.src = objectUrl;
//   }
// });


  
    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveEvents.php",
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
      data: "event_name",
      render: function (data, type, row) {
        return '<div style="white-space:normal;">' + data + '</div>';
      }
    },
    { "data": "date" },
    { "data": "start_time" },
    { "data": "end_time" },
    {
      "data": "main_image",
      "render": function(data, type, row, meta) {
        if(data){
          return '<img src="tlukadmin/'+data+'" alt="Event Image" style="width: 80px; height: auto; border-radius: 4px;" />';
        } else {
          return 'No Image';
        }
      }
    },
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `<a href="editEvents.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editEvents.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

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
      url  : "actions/saveEvents.php",
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

CKEDITOR.replace('description1', {
    width: '100%',
    height: '300px',
    extraAllowedContent: '*[*]{*}',   
    removePlugins: 'elementspath',
    resize_enabled: true,
    toolbar: [
      { name: 'document', items: ['Source', 'Preview', 'Print'] },
      { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'Undo', 'Redo'] },
      { name: 'editing', items: ['Find', 'Replace', 'SelectAll', 'Scayt'] },
      '/',
      { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting'] },
      { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
      { name: 'links', items: ['Link', 'Unlink'] },
      { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
      '/',
      { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
      { name: 'colors', items: ['TextColor', 'BGColor'] },
      { name: 'tools', items: ['Maximize'] }
    ],
  });
    CKEDITOR.replace('description2', {
    width: '100%',
    height: '300px',
    extraAllowedContent: '*[*]{*}',   
    removePlugins: 'elementspath',
    resize_enabled: true,
    toolbar: [
      { name: 'document', items: ['Source', 'Preview', 'Print'] },
      { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'Undo', 'Redo'] },
      { name: 'editing', items: ['Find', 'Replace', 'SelectAll', 'Scayt'] },
      '/',
      { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting'] },
      { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
      { name: 'links', items: ['Link', 'Unlink'] },
      { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
      '/',
      { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
      { name: 'colors', items: ['TextColor', 'BGColor'] },
      { name: 'tools', items: ['Maximize'] }
    ],
  });

$(function() {
  
  $("form[name='addformpage']").validate({
   
    rules: {        
      event_name          : "required",
      date          : "required",
      start_time          : "required",
      end_time          : "required",
      main_image          : "required",
      description1          : "required",
      // image          : "required",
      description2          : "required",
      event_location          : "required",
     
    },

    messages: {         
      event_name          : "Please Enter Event Name",
      date          : "Please Enter Date",
      start_time          : "Please Enter Start Time",
      end_time          : "Please Enter End Time",
      main_image          : "Please Upload the Main image",
      description1          : "Please Enter Description",
      // image          : "Please Upload the image",
      description2          : "Please Enter Description",
      event_location          : "Please Enter Event Location",
      
    },
    
    submitHandler: function(form) {
   
      
        let formdata = new FormData();
     
         var description1 = CKEDITOR.instances.description1.getData();
     var description2 = CKEDITOR.instances.description2.getData();
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){

          formdata.append(field.name, field.value);
        
          
        });
         formdata.append('description1', description1);
        formdata.append('description2', description2);
        formdata.append('action' , 'save'); 
         

         // let imageFields = ['main_image', 'image'];
         //  imageFields.forEach(function(field){
         //    let files = $('#' + field)[0].files;
         //    if(files.length > 0){
         //      formdata.append(field, files[0]);
         //    }
         //  });
               ['main_image', 'image'].forEach(function(field) {
  if (convertedBlobs[field]) {
    formdata.append(field, convertedBlobs[field], `${field}.webp`);
  }
});


          $("#save").attr("disabled", true);
         $('#pageloader').show();

        $.ajax({
          type: "POST",
          url: "actions/saveEvents.php",
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
                location.href = "manageEvents.php";
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
      event_location          : "required",
     
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
      event_location          : "Please Enter Event Location",
      
    },
    
    
    submitHandler: function(form) {
     // alert("hii");
      
        let formdata = new FormData();
       var description1 = CKEDITOR.instances.description1.getData();
     var description2 = CKEDITOR.instances.description2.getData();

      
        let x = $('#editform').serializeArray();
        $.each(x, function(i, field){
        
        formdata.append(field.name, field.value);
        
        });
         formdata.append('description1', description1);
        formdata.append('description2', description2);
        formdata.append('action' , 'update');

         // let imageFields = ['main_image', 'image'];
         //  imageFields.forEach(function(field){
         //    let files = $('#' + field)[0].files;
         //    if(files.length > 0){
         //      formdata.append(field, files[0]);
         //    }
         //  });
               ['main_image', 'image'].forEach(function(field) {
  if (convertedBlobs[field]) {
    formdata.append(field, convertedBlobs[field], `${field}.webp`);
  }
});
          
        $("#save").attr("disabled", true);
         $('#pageloader').show();  
    
      
       

        $.ajax({
          type: "POST",
          url: "actions/saveEvents.php",
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
                location.href = "manageEvents.php";
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

