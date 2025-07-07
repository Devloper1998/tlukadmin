function loadData() {


  
    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveContactUsers.php",
    type: 'post',
    data: { 'action': 'Display'},
  },
  "columns": [
    {
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    },
   
    { "data": "name" },
    { "data": "email" },
    {
      "data": "phone"},
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `<a href="viewContactUsers.php?type=view&randomId=${oData.randomId}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                
               
                

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
      url  : "actions/saveContactUsers.php",
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