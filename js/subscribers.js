function loadData() {
  $("#Form_Table").dataTable().fnDestroy();

  var table = $('#Form_Table').DataTable({
    "processing": true,
    "serverSide": false,
    "pagingType": "full_numbers",
    "ajax": {
      url: "actions/saveSubscribers.php",
      type: 'post',
      data: { 'action': 'Display' },
    },
    "columns": [
      {
        title: "S.No",
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { "data": "firstname" },
      { "data": "lastname" },
      { "data": "email" },
      {
        "data": "id",
        "render": function (data, type, row) {
          return `<a href="#" title="Delete" onclick="RemoveAccount(${data})"><i class="fas fa-trash"></i></a>`;
        }
      }
    ],
    dom: 'Bfrtip', // Add export buttons above table
    buttons: [
      {
        extend: 'csvHtml5',
        text: 'Download CSV',
        filename: 'subscribers_list',
        exportOptions: {
          columns: [3] // Export S.No, firstname, lastname, email
        }
      }
    ],
    select: true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    columnDefs: [
      { className: 'text-center', targets: [0, 4] }
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
      url  : "actions/saveSubscribers.php",
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