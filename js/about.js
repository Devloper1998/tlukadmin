let convertedWebPBlob = null;
let convertedWeb1PBlob = null;
$(function () {
  $("#image")
    .off("change")
    .on("change", function (event) {
      const input = event.target;
      const file = input.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
          // 🔁 Resize image using canvas
          const canvas = document.createElement("canvas");
          canvas.width = 960;
          canvas.height = 572;
          const ctx = canvas.getContext("2d");
          ctx.drawImage(img, 0, 0, 960, 572);

          // 🔁 Convert to WebP
          canvas.toBlob(
            function (blob) {
              convertedWebPBlob = blob;

              // 👁️ Show preview
              const previewURL = URL.createObjectURL(blob);
              $("#previewImage").attr("src", previewURL).show();
            },
            "image/webp",
            0.8
          ); // Quality
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  $("#image1")
    .off("change")
    .on("change", function (event) {
      const input = event.target;
      const file = input.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
          // 🔁 Resize image using canvas
          const canvas = document.createElement("canvas");
          canvas.width = 960;
          canvas.height = 572;
          const ctx = canvas.getContext("2d");
          ctx.drawImage(img, 0, 0, 960, 572);

          // 🔁 Convert to WebP
          canvas.toBlob(
            function (blob) {
              convertedWeb1PBlob = blob;

              // 👁️ Show preview
              const previewURL = URL.createObjectURL(blob);
              $("#previewImage1").attr("src", previewURL).show();
            },
            "image/webp",
            0.8
          ); // Quality
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });

  CKEDITOR.replace("description", {
    width: "100%",
    height: "300px",
    extraAllowedContent: "*[*]{*}",
    removePlugins: "elementspath",
    resize_enabled: true,
    toolbar: [
      { name: "document", items: ["Source", "Preview", "Print"] },
      {
        name: "clipboard",
        items: ["Cut", "Copy", "Paste", "PasteText", "Undo", "Redo"],
      },
      { name: "editing", items: ["Find", "Replace", "SelectAll", "Scayt"] },
      "/",
      {
        name: "basicstyles",
        items: [
          "Bold",
          "Italic",
          "Underline",
          "Strike",
          "RemoveFormat",
          "CopyFormatting",
        ],
      },
      {
        name: "paragraph",
        items: [
          "NumberedList",
          "BulletedList",
          "-",
          "Outdent",
          "Indent",
          "-",
          "Blockquote",
          "JustifyLeft",
          "JustifyCenter",
          "JustifyRight",
          "JustifyBlock",
        ],
      },
      { name: "links", items: ["Link", "Unlink"] },
      {
        name: "insert",
        items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
      },
      "/",
      { name: "styles", items: ["Styles", "Format", "Font", "FontSize"] },
      { name: "colors", items: ["TextColor", "BGColor"] },
      { name: "tools", items: ["Maximize"] },
    ],
  });

  CKEDITOR.replace("description1", {
    width: "100%",
    height: "300px",
    extraAllowedContent: "*[*]{*}",
    removePlugins: "elementspath",
    resize_enabled: true,
    toolbar: [
      { name: "document", items: ["Source", "Preview", "Print"] },
      {
        name: "clipboard",
        items: ["Cut", "Copy", "Paste", "PasteText", "Undo", "Redo"],
      },
      { name: "editing", items: ["Find", "Replace", "SelectAll", "Scayt"] },
      "/",
      {
        name: "basicstyles",
        items: [
          "Bold",
          "Italic",
          "Underline",
          "Strike",
          "RemoveFormat",
          "CopyFormatting",
        ],
      },
      {
        name: "paragraph",
        items: [
          "NumberedList",
          "BulletedList",
          "-",
          "Outdent",
          "Indent",
          "-",
          "Blockquote",
          "JustifyLeft",
          "JustifyCenter",
          "JustifyRight",
          "JustifyBlock",
        ],
      },
      { name: "links", items: ["Link", "Unlink"] },
      {
        name: "insert",
        items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
      },
      "/",
      { name: "styles", items: ["Styles", "Format", "Font", "FontSize"] },
      { name: "colors", items: ["TextColor", "BGColor"] },
      { name: "tools", items: ["Maximize"] },
    ],
  });

  $("form[name='addformpage']").validate({
    rules: {
      description: "required",
      // image          : "required",
    },

    messages: {
      description: "Please Enter description",
      // image          : "Please upload image",
    },

    submitHandler: function (form) {
      let formdata = new FormData();
      var description = CKEDITOR.instances.description.getData();
      var description1 = CKEDITOR.instances.description1.getData();
      let x = $("#addformpage").serializeArray();
      $.each(x, function (i, field) {
        formdata.append(field.name, field.value);
      });
      formdata.append("description", description);
      formdata.append("description1", description1);
      formdata.append("action", "update");

      if (convertedWebPBlob) {
        formdata.append("image", convertedWebPBlob, "converted.webp");
      }

      if (convertedWeb1PBlob) {
        formdata.append("image1", convertedWeb1PBlob, "converted1.webp");
      } else {
        // explicitly send empty if no new image1
        formdata.append("image1", "");
      }
      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveAbout.php",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        data: formdata,
        success: function (data) {
          if (data.trim() == "true") {
            $("#pageloader").hide();
            $("#save").attr("disabled", false);
            toastr.success("Updated Successfully...!");
            setTimeout(function () {
              location.href = "manageAbout.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        },
      });
    },
  });
});
