$(function() {

	$('#image').on('change', function(event) {
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

CKEDITOR.replace('story_description', {
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
      story_description          : "required",
      // image          : "required",
    
     
    },

    messages: {         
      story_description          : "Please Enter description",
      // image          : "Please upload image",
    
      
    },
  
    submitHandler: function(form) {
        let formdata = new FormData();
        var story_description = CKEDITOR.instances.story_description.getData();
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){
        if (field.name == "story_description") {
          formdata.append(field.name, story_description);
        } else {
          formdata.append(field.name, field.value);
        }
      });
        formdata.append('action' , 'updatedesc'); 

        
        $("#save").attr("disabled", true);
         $('#pageloader').show();
    

        $.ajax({
          type: "POST",
          url: "actions/saveStories.php",
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
                location.href = "manageStoryDesc.php";
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