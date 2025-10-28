function loadData() {
  $("#Form_Table").dataTable().fnDestroy();
  var table = $("#Form_Table").DataTable({
    processing: true,
    serverSide: false,
    pagingType: "full_numbers",
    ajax: {
      url: "actions/saveEventCategory.php",
      type: "post",
      data: { action: "Display" },
    },
    columns: [
      {
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      { data: "category_name" },

      {
        data: "id",
        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
          bnTd = `
                <a href="editEventCategory.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;
               
                

                <a href="#" title="Delete" onclick="RemoveAccount(${oData.id})"><i class="fas fa-trash"></i></a>&nbsp;&nbsp; `;
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
      url: "actions/saveEventCategory.php",
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
      category_name: "required",
    },

    messages: {
      category_name: "Please Enter Category Name",
    },

    submitHandler: function (form) {
      let formdata = new FormData();

      let x = $("#addformpage").serializeArray();
      $.each(x, function (i, field) {
        formdata.append(field.name, field.value);
      });

      formdata.append("action", "save");

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveEventCategory.php",
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
              location.href = "manageEventCategory.php";
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
    rules: {
      category_name: "required",
    },

    messages: {
      category_name: "Please Enter Category Name",
    },

    submitHandler: function (form) {
      // alert("hii");

      let formdata = new FormData();

      let x = $("#editform").serializeArray();
      $.each(x, function (i, field) {
        formdata.append(field.name, field.value);
      });

      formdata.append("action", "update");

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveEventCategory.php",
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
              location.href = "manageEventCategory.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        },
      });
    },
  });
});

function getValue(v) {
  $.ajax({
    url: "actions/saveEventCategory.php",
    type: "POST",
    data: { v: v, action: "verify_category" },
    success: function (data) {
      if (data == "true") {
        toastr.error("Category Already Exists");
        $("#category_name").val("");
      }
    },
  });
}
