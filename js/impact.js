$(function() {
$('#image').off('change').on('change', function (event) {
  var input = event.target;
  var file = input.files[0];

  if (file) {
    var img = new Image();
    var objectUrl = URL.createObjectURL(file);

    img.onload = function () {
      var width = this.width;
      var height = this.height;

      if (width !== 800 || height !== 526) {
        alert("Image must be exactly 800×526 pixels.");
        $(input).val('');
        $('#previewImage').hide();
        URL.revokeObjectURL(objectUrl);
        return;
      }
      
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#previewImage').attr('src', e.target.result).show();
      };
      reader.readAsDataURL(file);

      URL.revokeObjectURL(objectUrl);
    };

    img.src = objectUrl;
  }
});

  CKEDITOR.replace('description', {
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


  
  $("form[name='addformpage']").validate({

    
      rules: {        
      description          : "required",
      // image          : "required",
    
     
    },

    messages: {         
      description          : "Please Enter description",
      // image          : "Please upload image",
    
      
    },
  
    submitHandler: function(form) {
        let formdata = new FormData();
        var description = CKEDITOR.instances.description.getData();
        
        let x = $('#addformpage').serializeArray();
         $.each(x, function(i, field){
        if (field.name == "description") {
          formdata.append(field.name, description);
        } else {
          formdata.append(field.name, field.value);
        }
      });
        formdata.append('action' , 'update'); 
         let image = $('#image')[0].files;

	      if (image.length > 0){
	        formdata.append('image', image[0]);
	      }  
        $("#save").attr("disabled", true);
         $('#pageloader').show(); 
    

        $.ajax({
          type: "POST",
          url: "actions/saveImpact.php",
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
                location.href = "manageOurImpact.php";
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