<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
  
   $winnerqry = "select tw.*,te.event_name as ename , ts.sponsor_name as sname from tluk_winners as tw left join tluk_events as te on te.id = tw.event_name left join tluk_sponsors as ts on ts.id = tw.sponsor_name   WHERE tw.randomId = '".$randomId."'";
   $winnerData = $crud->getData($winnerqry);

   $selEvents = "select * from tluk_events";
   $getEvents  = $crud->getData($selEvents);
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
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">

                                    <form name="editform" id="editform" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php if ($_GET['type']=='view') { ?>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Winner Name</label>
                                                    <input type="text" name="winner_name" id="winner_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['winner_name'];?>" readonly>

                                                </div>
                                            </div>

                                            <div class="col-6">
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
                                            </div>




                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Winner Name</label>
                                                    <input type="text" name="winner_name" id="winner_name"
                                                        class="form-control"
                                                        value="<?php echo $winnerData[0]['winner_name'];?>">

                                                </div>
                                            </div>
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
                                                    <label>Sponsor Name</label>
                                                    <select name="sponsor_name" id="sponsor_name" class="form-control">
                                                        <option value=""> -- select option---</option>
                                                        <?php foreach ($getSponsor as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>"
                                                            <?php if ($value['id'] == $winnerData[0]['sponsor_name']) {echo "selected"; }?>>
                                                            <?php echo $value['sponsor_name']?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>



                                            <?php } ?>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWinners.php'">Cancel</button>
                                            </div>
                                            <?php if ($_GET['type'] == 'edit') { ?>
                                            <div class="col-6">
                                                <input type="hidden" name="hdn_id" id="hdn_id"
                                                    value="<?php echo $winnerData[0]['randomId']; ?>">
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
    </div>

    <?php include('includes/footer.php'); ?>

</body>
<script type="text/javascript" src="js/winner.js"></script>

</html>