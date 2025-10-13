let convertedBlobs = {
  sponsor_logo: null,
};
function loadData() {
  $(".image-upload").on("change", function (event) {
    const input = event.target;
    const previewSelector = $(this).data("preview");
    const file = input.files[0];
    const fieldId = input.id;

    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
      const img = new Image();
      img.onload = function () {
        let requiredWidth = img.width;
        let requiredHeight = img.height;

        if (fieldId === "sponsor_logo") {
          requiredWidth = 800;
          requiredHeight = 600;
        }

        // Resize using canvas
        const canvas = document.createElement("canvas");
        canvas.width = requiredWidth;
        canvas.height = requiredHeight;
        const ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, requiredWidth, requiredHeight);

        // Convert to webp
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

  $("#Form_Table").dataTable().fnDestroy();
  var table = $("#Form_Table").DataTable({
    processing: true,
    serverSide: false,
    pagingType: "full_numbers",
    ajax: {
      url: "actions/saveSponsors.php",
      type: "post",
      data: { action: "Display" },
    },
    columns: [
      {
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },

      { data: "sponsor_name" },
      {
        data: "sponsor_logo",
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
      { data: "sponsor_link" },
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
          bnTd = `<a href="editSponsors.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editSponsors.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="#" title="Delete" onclick="RemoveAccount(${oData.id})"><i class="fas fa-trash"></i></a>&nbsp;&nbsp; `;
          if (oData.status == "1") {
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
}

$(document).ready(function () {
  loadData();
});

function RemoveAccount(id) {
  let check = confirm("Are You Sure You want To delete This Data..?");
  if (check) {
    $.ajax({
      url: "actions/saveSponsors.php",
      type: "post",
      data: { id: id, action: "delete" },
      success: function (data) {
        if (data == "true") {
          toastr.success("deleted successfully...!");
          loadData();
        }
      },
    });
  }
  return false;
}

$(function () {
  $("form[name='addformpage']").validate({
    rules: {
      sponsor_name: "required",
      // sponsor_link: "required",
    },

    messages: {
      sponsor_name: "Please Enter Sponsor name",
      // sponsor_link: "Please Enter Sponsor Link",
    },

    submitHandler: function (form) {
      let formdata = new FormData();

      let x = $("#addformpage").serializeArray();
      $.each(x, function (i, field) {
        formdata.append(field.name, field.value);
      });

      formdata.append("action", "save");

      let sponsor_logo = $("#sponsor_logo")[0].files;

      if (sponsor_logo.length > 0) {
        formdata.append("sponsor_logo", sponsor_logo[0]);
      }

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveSponsors.php",
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
              location.href = "manageSponsors.php";
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
      let formdata = new FormData();

      let x = $("#editform").serializeArray();
      $.each(x, function (i, field) {
        formdata.append(field.name, field.value);
      });

      formdata.append("action", "update");
      let sponsor_logo = $("#sponsor_logo")[0].files;

      if (sponsor_logo.length > 0) {
        formdata.append("sponsor_logo", sponsor_logo[0]);
      }

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveSponsors.php",
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
              location.href = "manageSponsors.php";
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
  $.ajax({
    url: "actions/saveSponsors.php",
    type: "post",
    data: { id: id, status: status, action: "changeStatus" },
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

$(document).on("change blur", ".sorting-order-input", function () {
  var id = $(this).data("id");
  var value = $(this).val();
  if (value !== "") {
    $.ajax({
      url: "actions/saveSponsors.php",
      type: "POST",
      data: { id: id, sorting_order: value, action: "updateSortingOrder" },
      success: function (data) {
        if (data === "true") {
          toastr.success("Sorting order saved!");
        } else {
          toastr.error("Failed to save sorting order");
        }
      },
    });
  }
});
