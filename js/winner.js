function loadData() {
  $("#Form_Table").dataTable().fnDestroy();
  var table = $("#Form_Table").DataTable({
    processing: true,
    serverSide: false,
    pagingType: "full_numbers",
    ajax: {
      url: "actions/saveWinners.php",
      type: "post",
      data: { action: "Display" },
    },
    columns: [
      {
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "winner_name",
        render: function (data, type, row) {
          return '<div style="white-space:normal;">' + data + "</div>";
        },
      },
      { data: "ename" },
      { data: "gift" },
      { data: "sname" },
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
          bnTd = `<a href="editWinners.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                <a href="editWinners.php?type=edit&randomId=${oData.randomId}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;

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
      url: "actions/saveWinners.php",
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
      winner_name: "required",
      event_name: "required",
      gift: "required",
      sponsor_name: "required",
    },

    messages: {
      winner_name: "Please Enter Winner Name",
      event_name: "Please Enter Event Name",
      gift: "Please Enter Gift Name",
      sponsor_name: "Please Enter Sponsor name",
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
        url: "actions/saveWinners.php",
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
              location.href = "manageWinners.php";
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

      $("#save").attr("disabled", true);
      $("#pageloader").show();

      $.ajax({
        type: "POST",
        url: "actions/saveWinners.php",
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
              location.href = "manageWinners.php";
            }, 1000);
          } else {
            toastr.error(data);
          }
        },
      });
    },
  });
});

$(document).on("change blur", ".sorting-order-input", function () {
  var id = $(this).data("id");
  var value = $(this).val();
  if (value !== "") {
    $.ajax({
      url: "actions/saveWinners.php",
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
