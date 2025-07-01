function loadData() {

    $('.image-upload').on('change', function(event) {
  var input = event.target;
  var previewSelector = $(this).data('preview');

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $(previewSelector).attr('src', e.target.result).show();
    }

    reader.readAsDataURL(input.files[0]);
  }
});



  
    $("#Form_Table").dataTable().fnDestroy();
   var table = $('#Form_Table').DataTable({
  "processing": true,
  "serverSide": false,
  "pagingType": "full_numbers",
  "ajax": {
    url: "actions/saveFeatureBusiness.php",
    type: 'post',
    data: { 'action': 'DisplayNonFeatured'},
  },
  "columns": [
    {
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    },
    { "data": "title" },
    {
      "data": "main_image",
      "render": function(data, type, row, meta) {
        if(data){
          return '<img src="tlukadmin/'+data+'" alt="Event Image" style="width: 80px; height: auto; border-radius: 4px;" />';
        } else {
          return 'No Image';
        }
      }
    },
    {
        "data": "description",
        "render": function (data, type, row, meta) {
          if (data.length > 50) {
            return '<span title="' + data.replace(/"/g, '&quot;') + '">' + data.substr(0, 50) + '...</span>';
          } else {
            return data;
          }
        }
      },
   
    { "data": "id",
      "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                bnTd = `<a href="#" title="Delete" onclick="RemoveAccount(${oData.id})"><i class="fas fa-trash"></i></a>&nbsp;&nbsp; `;
                
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
      url  : "actions/saveFeatureBusiness.php",
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

 


    


  


