<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
  
    $winnerqry = "select tw.*,tw.id as winnerId,tw.randomId as winerrand,twl.*,twl.randomId as randw,twl.image as winnerImage,tec.category_name,te.event_name as ename , ts.sponsor_name as sname from tluk_winners as tw left join tluk_events as te on te.id = tw.event_name left join tluk_eventcategories as tec on tec.id = tw.eventcategory_name left join tluk_winnerslist as twl on twl.winner_id = tw.id   left join tluk_sponsors as ts on ts.id = twl.sponsor_name  WHERE tw.randomId = '".$randomId."'";
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

                                                                <span><?php echo $value['sname'];?></span>
                                                            </td>

                                                            <td>
                                                                <img src="tlukadmin/<?php echo htmlspecialchars($value['image']); ?>"
                                                                    alt="Winner Image"
                                                                    style="width:100px;height:auto;border-radius:6px;">
                                                                </img>
                                                            </td>
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
                                                                <select name="sponsor_name[]" class="form-control">
                                                                    <option value="">-- Select option --</option>
                                                                    <?php foreach ($getSponsor as $sponsor) { ?>
                                                                    <option value="<?php echo $sponsor['id']; ?>"
                                                                        <?php if ($sponsor['id'] == $value['sponsor_name']) { echo "selected"; } ?>>
                                                                        <?php echo htmlspecialchars($sponsor['sponsor_name']); ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>

                                                                <input type="file" name="winner_image[]"
                                                                    id="winner_image" class="form-control">
                                                                <input type="hidden" class="form-control"
                                                                    name="old_image[]" id="old_image"
                                                                    value="<?php echo $value['winnerImage']; ?>">
                                                                <input type="hidden" name="hidden_id[]" id="hidden_id"
                                                                    class="form-control"
                                                                    value="<?php echo $value['randw']; ?>">
                                                                <?php if (!empty($value['winnerImage'])) { ?>
                                                                <img src="tlukadmin/<?php echo htmlspecialchars($value['image']); ?>"
                                                                    alt="Winner Image"
                                                                    style="width:100px;height:auto;border-radius:6px;">
                                                                </img>
                                                                <?php } ?>

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
             <select name="sponsor_name[]" id="sponsor_name${count+1}" class="form-control">
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
       <td style="text-align: center;">
         <a href="javascript:void(0)" class="btn btn-danger remove">-</a>
       </td>
       <td style="text-align: center;">
         <a href="javascript:void(0)" class="btn btn-info addRow" onclick="add()">+</a>
       </td>
    </tr>`;

    $('tbody.table1').append(addTr);
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