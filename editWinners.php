<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
  
     $winnerqry = "SELECT tw.*,tw.id AS winnerId,tw.randomId AS winerrand,tec.category_name,te.event_name AS ename,twl.id AS winnerListId, twl.image AS winnerImage,twl.gift,twl.winner_name,twl.randomId as randw, twl.winner_order,
    (
        SELECT GROUP_CONCAT(ts.sponsor_name SEPARATOR ', ')
        FROM tluk_sponsors ts
        WHERE FIND_IN_SET(ts.id, twl.sponsor_name)
    ) AS sname FROM tluk_winners AS tw LEFT JOIN tluk_events AS te ON te.id = tw.event_name
LEFT JOIN tluk_eventcategories AS tec ON tec.id = tw.eventcategory_name
LEFT JOIN tluk_winnerslist AS twl ON twl.winner_id = tw.id
WHERE tw.randomId = '".$randomId."'";
   $winnerData = $crud->getData($winnerqry);




 

   


   $selEvents = "select * from tluk_events";
   $getEvents  = $crud->getData($selEvents);
   $selEventCategory = "select * from tluk_eventcategories";
   $getEventCategory = $crud->getData($selEventCategory);
   $selSponsor = "select * from tluk_sponsors";
   $getSponsor = $crud->getData($selSponsor);
   

?>

<body>
    <div id="layout-wrapper">

        <?php include('includes/navbar.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">
                                    <?php if ($_GET['type']=='view') { ?>
                                    View Winners
                                    <?php } ?>
                                    <?php if ($_GET['type']=='edit') { ?>
                                    Edit Winners
                                    <?php } ?>
                                </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            <?php if ($_GET['type']=='view') { ?>
                                            View Winners
                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>
                                            Edit Winners
                                            <?php } ?>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end breadcrumb -->

                    <!-- Page Content -->
                    <div class="row">
                        <!-- <div class="col-md-2"></div> -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <form name="editform" id="editform" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php if ($_GET['type']=='view') { ?>
                                            <!-- <div class="col-6">
                                                <div class="form-group">
                                                    <label>Winner Name</label>
                                                    <input type="text" name="winner_name" id="winner_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['winner_name'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Gift</label>
                                                    <input type="text" name="gift" id="gift" class="form-control"
                                                        value="<?php echo $winnerData[0]['gift'];?>" readonly>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name</label>
                                                    <input type="text" name="event_name" id="event_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['ename'];?>" readonly>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Name</label>
                                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['sname'];?>" readonly>

                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name</label>
                                                    <input type="text" name="event_name" id="event_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['ename'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Category</label>
                                                    <input type="text" name="event_categoryname" id="event_categoryname"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['category_name'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <table class="table table-bordered" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Winner Name</th>
                                                            <th>Gift</th>
                                                            <th>Sponsor Name</th>
                                                            <th>Winner Image</th>
                                                            <th>Winner Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;foreach ($winnerData as $key => $value) { ?>
                                                        <tr>
                                                            <td><?php echo $i;?></td>
                                                            <td>

                                                                <span><?php echo $value['winner_name'];?></span>

                                                            </td>
                                                            <td>

                                                                <span><?php echo $value['gift'];?></span>
                                                            </td>

                                                            <td>
                                                                <span>
                                                                    <?php echo $value['sname']; ?>
                                                                </span>
                                                            </td>


                                                            <td>
                                                                <img src="tlukadmin/<?php echo htmlspecialchars($value['winnerImage']); ?>"
                                                                    alt="Winner Image"
                                                                    style="width:100px;height:auto;border-radius:6px;">
                                                                </img>
                                                            </td>
                                                            <td><?php echo $value['winner_order'];?></td>
                                                        </tr>
                                                        <?php $i++;} ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name</label>
                                                    <select name="event_name" id="event_name" class="form-control">
                                                        <option value=""> -- select option---</option>
                                                        <?php foreach ($getEvents as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>"
                                                            <?php if ($value['id'] == $winnerData[0]['event_name']) {echo "selected"; }?>>
                                                            <?php echo $value['event_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Category <span class="star">*</span></label>
                                                    <select name="eventcategory_name" id="eventcategory_name"
                                                        class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getEventCategory as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>"
                                                            <?php if ($value['id'] == $winnerData[0]['eventcategory_name']) { echo "selected"; } ?>>
                                                            <?php echo $value['category_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="broucher_hide">
                                                <table class="table table-bordered table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Winner Name</th>
                                                            <th>Gift</th>
                                                            <th>Sponsor Name</th>
                                                            <th>Winner Image</th>
                                                            <th>Winner Order</th>
                                                            <th></th>
                                                        </tr>

                                                    </thead>
                                                    <tbody class="table1">
                                                        <?php $i =1;foreach ($winnerData as $key => $value) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i;?>
                                                            </td>
                                                            <td>
                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <input type="text" name="winner_name[]"
                                                                            id="winner_name" class="form-control"
                                                                            value="<?php echo $value['winner_name'];?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <input type="text" name="gift[]" id="gift"
                                                                            class="form-control"
                                                                            value="<?php echo $value['gift'];?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <select
                                                                            name="sponsor_name[<?php echo $i-1; ?>][]"
                                                                            class="form-control sponsor-select"
                                                                            multiple>
                                                                            <option value="">-- Select option --
                                                                            </option>
                                                                            <?php 
                                                                             $test = $winnerData[0]['sname'];
                                                                            
                                                                           
          $rowSponsorIds = explode(',', $test);
          print_r($rowSponsorIds);
          foreach ($getSponsor as $sponsor) { 
              $selected = in_array($sponsor['id'], $rowSponsorIds) ? 'selected' : '';
        ?>
                                                                            <option
                                                                                value="<?php echo $sponsor['id']; ?>"
                                                                                <?php echo $selected; ?>>
                                                                                <?php echo htmlspecialchars($sponsor['sponsor_name']); ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>

                                                                <input type=" file" name="winner_image[]"
                                                                    id="winner_image" class="form-control">
                                                                <input type="hidden" class="form-control"
                                                                    name="old_image[]" id="old_image"
                                                                    value="<?php echo $value['winnerImage']; ?>">
                                                                <input type="hidden" name="hidden_id[]" id="hidden_id"
                                                                    class="form-control"
                                                                    value="<?php echo $value['randw']; ?>">
                                                                <?php if (!empty($value['winnerImage'])) { ?>
                                                                <img src="tlukadmin/<?php echo htmlspecialchars($value['winnerImage']); ?>"
                                                                    alt="Winner Image"
                                                                    style="width:100px;height:auto;border-radius:6px;">
                                                                </img>
                                                                <?php } ?>

                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                    name="winnerOrder[]" id="winnerOrder"
                                                                    value="<?php echo $value['winner_order'];?>">
                                                            </td>

                                                            <td style="text-align:center;">
                                                                <?php if ($i == count($winnerData)) { ?>

                                                                <a href="javascript:void(0)" class="btn btn-danger "
                                                                    onclick="remove('<?php echo $value['randw'];?>')">-</a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-info addRow">+</a>
                                                                <?php } else { ?>
                                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                                    onclick="remove('<?php echo $value['randw'];?>')">-</a>
                                                                <?php } ?>
                                                            </td>

                                                        </tr>
                                                        <?php $i++;} ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } ?>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWinners.php'">Cancel</button>
                                            </div>
                                            <?php if ($_GET['type'] == 'edit') { ?>
                                            <div class="col-6">
                                                <input type="hidden" name="hdn_id" id="hdn_id"
                                                    value="<?php echo $winnerData[0]['winerrand']; ?>">
                                                <input type="hidden" class="form-control" name="winner_id"
                                                    id="winner_id" value="<?php echo $winnerData[0]['winnerId']; ?>">
                                                <button type="submit" id="save"
                                                    class="btn btn-success float-right">Update</button>
                                            </div>
                                            <?php } ?>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- End Page Content -->

                </div>
            </div>
        </div>
    </div>w

    <?php include('includes/footer.php'); ?>

</body>
<script type="text/javascript" src="js/winner.js"></script>
<script>
function addrow() {
    let count = $('.table1 tr').length;
    var addTr = `<tr style="margin:10px 0px">
       <td><span id="counter">${count+1}</span></td>
       <td>
         <div class="col-12">
           <div class="form-group">
             <input type="text" name="winner_name[]" id="winner_name${count+1}" class="form-control" >
           </div>
         </div>
       </td>
       <td>
         <div class="col-12">
           <div class="form-group">
             <input type="text" name="gift[]" id="gift${count+1}" class="form-control">
           </div>
         </div>
       </td>
       <td>
         <div class="col-12">
           <div class="form-group">
             <select name="sponsor_name[]" id="sponsor_name${count+1}" class="form-control sponsor-select" multiple>
               <option value="">--select option--</option>
               <?php foreach ($getSponsor as $key => $value) { ?>
               <option value="<?php echo $value['id'] ?>">
                 <?php echo $value['sponsor_name']?>
               </option>
               <?php }?>
             </select>
           </div>
         </div>
       </td>
       <td>
         <input type="file" name="winner_image[]" id="winner_image${count+1}" class="form-control">
           <input type="hidden" class="form-control"
                name="old_image[]" id="old_image${count+1}"
                value="">
            <input type="hidden" name="hidden_id[]" id="hidden_id${count+1}"
                class="form-control"
                value="">
         
       </td>
       <td><input type="text" class="form-control"
                                                                    name="winnerOrder[]" id="winnerOrder${count+1}"
                                                                    >
                                                            </td>
       <td style="text-align: center;">
         <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
       </td>
       <td style="text-align: center;">
         <a href="javascript:void(0)" class="btn btn-info addRow" onclick="add()">+</a>
       </td>
    </tr>`;

    $('tbody.table1').append(addTr);
    $('.sponsor-select').select2({
        placeholder: "Select one or more sponsors"
    });
}





$('.addRow').on('click', function() {
    addrow();

});

function add() {
    addrow();
}

$('tbody').on('click', '.remove', function() {
    $(this).parent().parent().remove();
    $('.table1 tr').each(function(i) {
        $(this).find('td')[0].innerHTML = i + 1;
    })

});
</script>

</html>