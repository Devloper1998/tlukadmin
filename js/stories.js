const convertedBlobs = {
  main_image: null,
  profile_image: null,
  story_image1: null,
  story_image2: null
};
function loadData() {
   $('.image-upload').on('change', function (event) {
    const input = event.target;
    const file = input.files[0];
    const previewSelector = $(this).data('preview');
    const fieldId = input.id;

    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
      const img = new Image();
      img.onload = function () {
        let requiredWidth = 800;
        let requiredHeight = 600;

        switch (fieldId) {
          case 'main_image':
            requiredWidth = 800;
            requiredHeight = 600;
            break;
          case 'profile_image':
            requiredWidth = 400;
            requiredHeight = 400;
            break;
          case 'story_image1':
          case 'story_image2':
            requiredWidth = 1600;
            requiredHeight = 1200;
            break;
        }

        // Optional: validation
        // if (img.width < requiredWidth || img.height < requiredHeight) {
        //   alert(`${fieldId.replace(/_/g, ' ')} must be at least ${requiredWidth}×${requiredHeight} pixels.`);
        //   $(input).val('');
        //   $(previewSelector).hide();
        //   return;
        // }

        // Resize
        const canvas = document.createElement('canvas');
        canvas.width = requiredWidth;
        canvas.height = requiredHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, requiredWidth, requiredHeight);

        // WebP + Preview
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


  // Initialize DataTable
  $("#Form_Table").dataTable().fnDestroy();
  $('#Form_Table').DataTable({
    processing: true,
    serverSide: false,
    pagingType: "full_numbers",
    ajax: {
      url: "actions/saveStories.php",
      type: 'POST',
      data: { action: 'Display' },
    },
    columns: [
      {
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: "name" },
      { data: "designation" },
      {
        data: "profile_image",
        render: function (data) {
          return data
            ? `<img src="tlukadmin/${data}" alt="Image" style="width:80px;height:auto;border-radius:4px;" />`
            : 'No Image';
        }
      },
      {
        data: "id",
        fnCreatedCell: function (nTd, sData, oData) {
          var actionBtns = `
            <a href="editStories.php?type=view&randomId=${oData.randomId}" title="View">
              <i class="fa fa-eye"></i>
            </a>&nbsp;
            <a href="editStories.php?type=edit&randomId=${oData.randomId}" title="Edit">
              <i class="fa fa-pencil"></i>
            </a>&nbsp;
            <a href="#" title="Delete" onclick="RemoveAccount(${oData.id})">
              <i class="fas fa-trash"></i>
            </a>`;
          $(nTd).html(actionBtns);
        }
      }
    ],
    select: true,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    columnDefs: [
      { className: 'text-center', targets: [0, 4] },
      { orderable: false, targets: [4] }
    ],
    sPaginationType: 'full_numbers'
  });
}

function RemoveAccount(id) {
  if (confirm('Are you sure you want to delete this data?')) {
    $.ajax({
      url: "actions/saveStories.php",
      type: "POST",
      data: { id: id, action: 'delete' },
      success: function (data) {
        if (data.trim() === 'true') {
          toastr.success('Deleted successfully!');
          loadData();
        } else {
          toastr.error('Failed to delete.');
        }
      }
    });
  }
  return false;
}

$(document).ready(function () {
  loadData();
});

// CKEditor initialization
['description1', 'description2'].forEach(function (id) {
  CKEDITOR.replace(id, {
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
    ]
  });
});

// Form Validation for Add and Edit forms
function setupValidation(formName, submitAction) {
  $("form[name='" + formName + "']").validate({
    rules: {
      title: "required",
      name: "required",
      // designation: "required",
      main_image: submitAction === 'save' ? "required" : false,
      // profile_image: "required",
      story_description: "required",
      description1: "required",
      description2: "required"
      // date: "required",
      // start_time: "required",
      // end_time: "required"
    },
    messages: {
      title: "Please enter title",
      name: "Please enter name",
      // designation: "Please enter description",
      main_image: submitAction === 'save' ? "Please upload main image" : "",
      // profile_image: "Please upload profile image",
      story_description: "Please enter story description",
      description1: "Please enter description 1",
      description2: "Please enter description 2"
      // date: "Please select date",
      // start_time: "Please select start time",
      // end_time: "Please select end time"
    },
    submitHandler: function (form) {
      var formdata = new FormData(form);

      // Append CKEditor values
      ['story_description', 'description1', 'description2'].forEach(function (id) {
        if (CKEDITOR.instances[id]) {
          formdata.set(id, CKEDITOR.instances[id].getData());
        }
      });

      // Append selected files
      // ['main_image', 'profile_image', 'story_image1', 'story_image2'].forEach(function (field) {
      //   var fileInput = $('#' + field)[0];
      //   if (fileInput && fileInput.files.length > 0) {
      //     formdata.set(field, fileInput.files[0]);
      //   }
      // });
                   ['main_image', 'profile_image', 'story_image1', 'story_image2'].forEach(function(field) {
  if (convertedBlobs[field]) {
    formdata.append(field, convertedBlobs[field], `${field}.webp`);
  }
});

      formdata.append('action', submitAction);

      $("#save").prop("disabled", true);
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
          $('#pageloader').hide();
          $("#save").prop("disabled", false);

          if (data.trim() === 'true') {
            toastr.success(submitAction === 'save' ? 'Saved successfully!' : 'Updated successfully!');
            setTimeout(function () {
              location.href = "manageStories.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        }
      });
    }
  });
}

// Setup both add and edit form validation
$(function () {
  if ($("form[name='addformpage']").length) setupValidation('addformpage', 'save');
  if ($("form[name='editform']").length) setupValidation('editform', 'update');
});
