// let convertedMainImageBlob = null;

let convertedBlobs = {
  main_image: null,
  home_image: null,
  business_logo: null,
};

function loadData() {
  $(".image-upload")
    .off("change")
    .on("change", function (event) {
      const input = event.target;
      const file = input.files[0];
      const fieldId = input.id;
      const previewSelector = $(this).data("preview");

      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
          let requiredWidth = img.width;
          let requiredHeight = img.height;

          // Set custom resize dimensions for specific fields
          if (fieldId === "main_image") {
            requiredWidth = 800;
            requiredHeight = 600;
          }

          const canvas = document.createElement("canvas");
          canvas.width = requiredWidth;
          canvas.height = requiredHeight;

          const ctx = canvas.getContext("2d");
          ctx.drawImage(img, 0, 0, requiredWidth, requiredHeight);

          canvas.toBlob(
            function (blob) {
              convertedBlobs[fieldId] = blob;
              const previewURL = URL.createObjectURL(blob);
              $(previewSelector).attr("src", previewURL).show();
            },
            "image/webp",
            0.8
          );
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
}

// Business Logo (no conversion, just preview)

$("#Form_Table").dataTable().fnDestroy();
var table = $("#Form_Table").DataTable({
  processing: true,
  serverSide: false,
  pagingType: "full_numbers",
  ajax: {
    url: "actions/saveFeatureBusiness.php",
    type: "post",
    data: { action: "show" },
  },
  columns: [
    {
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      },
    },
    { data: "title" },
    {
      data: "main_image",
      render: function (data, type, row, meta) {
        if (data) {
          return (
            '<img src="tlukadmin/' +
            data +
            '" alt="Event Image" style="width: 80px; height: auto; border-radius: 4px;" />'
          );
        } else {
          return "No Image";
        }
      },
    },
    {
      data: "description",
      render: function (data, type, row, meta) {
        if (data.length > 50) {
          return (
            '<span style="white-space:normal;" title="' +
            data.replace(/"/g, "&quot;") +
            '">' +
            data.substr(0, 50) +
            "...</span>"
          );
        } else {
          return data;
        }
      },
    },
    {
      data: "sorting_order",
      render: function (data, type, row) {
        let val = data && data !== "0" ? data : "";
        return (
          '<input type="text" class="form-control sorting-order-input w-100" data-id="' +
          row.id +
          '" value="' +
          val +
          '" style="width:60px">'
        );
      },
    },

    {
      data: "id",
      fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
        bnTd = `<a href="editFeatureBusiness.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editFeatureBusiness.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

                <a href="#" title="Delete" onclick="RemoveAccount(${oData.id})"><i class="fas fa-trash"></i></a>&nbsp;&nbsp; `;
        if (oData.featuredstatus == "1") {
          bnTd += `<input type="checkbox" onclick="displayfeature(${oData.id},0)" name="displayItems" style="width:15px; height: 15px;" checked>`;
        } else {
          bnTd += `<input type="checkbox" onclick="displayfeature(${oData.id},1)" name="displayItems" style="width:15px; height: 15px;">`;
        }
        $(nTd).html(bnTd);
      },
    },
  ],
  select: true,
  lengthMenu: [
    [10, 25, 50, -1],
    [10, 25, 50, "All"],
  ],
  columnDefs: [{ className: "text-center", targets: [0, 5] }],
  aoColumnDefs: [{ bSortable: false, aTargets: ["no-sort"] }],
  sPaginationType: "full_numbers",
});

$(document).ready(function () {
  $(document).on("change blur", ".sorting-order-input", function () {
    const id = $(this).data("id");
    const value = $(this).val().trim();
    if (value === "") return;

    $.ajax({
      url: "actions/saveFeatureBusiness.php",
      type: "POST",
      data: { id: id, sorting_order: value, action: "updateSortingOrder" },
      success: function (data) {
        if (data.trim() === "true") {
          toastr.success("Sorting order updated successfully!");
        } else {
          toastr.error("Failed to update sorting order!");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        toastr.error("An error occurred while saving.");
      },
    });
  });
  loadData();
});

function RemoveAccount(id) {
  let check = confirm("Are You Sure You want To delete This Data..?");
  if (check) {
    $.ajax({
      url: "actions/saveFeatureBusiness.php",
      type: "post",
      data: { id: id, action: "delete" },
      success: function (data) {
        if (data == "true") {
          toastr.success("deleted successfully...!");
          // loadData();
          table.ajax.reload(null, false);
        }
      },
    });
  }
  return false;
}

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

$(function () {
  $("form[name='addformpage']").validate({
    rules: {
      catg_id: "required",
      title: "required",

      main_image: "required",
      description: "required",
      // discount          : "required",
      // address          : "required",
      // business_url          : "required",
      // accounts          : "required",
      // account_link          : "required",

      business_logo: "required",
    },

    messages: {
      catg_id: "Please Select Category",
      title: "Please Enter Title",

      main_image: "Please Upload the Main image",
      description: "Please Enter Description",
      // discount          : "Please Enter Discount",
      // address          : "Please Enter Address",
      // business_url          : "Please Enter Business URL",
      // accounts          : "Please Enter Social Account",
      // account_link          : "Please Enter social account link",

      business_logo: "Please upload business logo",
    },

    submitHandler: function (form) {
      let formdata = new FormData();
      var description = CKEDITOR.instances.description.getData();

      let x = $("#addformpage").serializeArray();
      $.each(x, function (i, field) {
        if (field.name == "description") {
          formdata.append(field.name, description);
        } else {
          formdata.append(field.name, field.value);
        }
      });
      formdata.append("action", "save");

      ["main_image", "home_image", "business_logo"].forEach(function (field) {
        if (convertedBlobs[field]) {
          formdata.append(field, convertedBlobs[field], `${field}.webp`);
        } else {
          // Try to append original file from input if user didn't change it (important!)
          const inputFile = document.getElementById(field);
          if (inputFile && inputFile.files.length > 0) {
            formdata.append(field, inputFile.files[0]);
          }
        }
      });

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveFeatureBusiness.php",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        data: formdata,
        success: function (data) {
          if (data.trim() == "true") {
            $("#pageloader").hide();
            $("#save").attr("disabled", false);
            toastr.success("Saved Successfully...!");
            setTimeout(function () {
              location.href = "manageFeatureBusiness.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        },
      });
    },
  });
});

$(function () {
  $("form[name='editform']").validate({
    submitHandler: function (form) {
      // alert("hii");

      let formdata = new FormData();
      var description = CKEDITOR.instances.description.getData();

      let x = $("#editform").serializeArray();
      $.each(x, function (i, field) {
        if (field.name == "description") {
          formdata.append(field.name, description);
        } else {
          formdata.append(field.name, field.value);
        }
      });
      formdata.append("action", "update");

      ["main_image", "home_image", "business_logo"].forEach(function (field) {
        if (convertedBlobs[field]) {
          formdata.append(field, convertedBlobs[field], `${field}.webp`);
        } else {
          // Try to append original file from input if user didn't change it (important!)
          const inputFile = document.getElementById(field);
          if (inputFile && inputFile.files.length > 0) {
            formdata.append(field, inputFile.files[0]);
          }
        }
      });

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveFeatureBusiness.php",
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
              location.href = "manageFeatureBusiness.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        },
      });
    },
  });
});

function displayfeature(id, status) {
  // alert(id);
  // alert(status);
  $.ajax({
    url: "actions/saveFeatureBusiness.php",
    type: "post",
    data: { id: id, status: status, action: "changeStatusFeature" },
    success: function (data) {
      if (data == "true") {
        toastr.success("Status Changed Successfully...!");
        loadData();
      } else if (data == "limit") {
        toastr.error("You Have reached The Limit Of 3");
        loadData();
      } else {
        toastr.error(data);
      }
    },
  });
}
