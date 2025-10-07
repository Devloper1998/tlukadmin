<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
  
    $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
   $selSponsors = "select * from tluk_sponsors where randomId ='".$randomId."' ";
   $getSponsors  = $crud->getData($selSponsors);
   $sponsor_logo= str_replace('../', '', $getSponsors[0]['sponsor_logo']);
   

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
                                    View Sponsors
                                    <?php } ?>
                                    <?php if ($_GET['type']=='edit') { ?>
                                    Edit Sponsors
                                    <?php } ?>
                                </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            <?php if ($_GET['type']=='view') { ?>
                                            View Sponsors
                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>
                                            Edit Sponsors
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
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Name</label>
                                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                                        class="form-control"
                                                        value="<?php echo $getSponsors[0]['sponsor_name'];?>" readonly>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Logo</label><br>
                                                    <img src="<?php echo $sponsor_logo;?>" width="100"
                                                        style="border-radius: 10px;">
                                                </div>
                                            </div>




                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Name</label>
                                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                                        class="form-control"
                                                        value="<?php echo $getSponsors[0]['sponsor_name'];?>">

                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Logo</label>
                                                    <input type="file" name="sponsor_logo" id="sponsor_logo"
                                                        class="form-control image-upload" data-preview="#previewImage"
                                                        accept="image\*">
                                                    <input type="hidden" name="oldsponsor_logo" id="oldsponsor_logo"
                                                        class="form-control"
                                                        value="<?php echo $getSponsors[0]['sponsor_logo'];?>">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>800px × 600px</strong><br>
                                                        <img id="previewImage"
                                                            style="display:none;border-radius: 10px; margin-top: 10px; margin-top: 10px;"
                                                            width="150" height="auto">
                                                        <img src="<?php echo $sponsor_logo;?>" width="100"
                                                            style="border-radius: 10px;margin-top: 10px;">

                                                </div>
                                            </div>


                                            <?php } ?>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageSponsors.php'">Cancel</button>
                                            </div>
                                            <?php if ($_GET['type'] == 'edit') { ?>
                                            <div class="col-6">
                                                <input type="hidden" name="hdn_id" id="hdn_id"
                                                    value="<?php echo $getSponsors[0]['randomId']; ?>">
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
<script type="text/javascript" src="js/sponsor.js"></script>

</html>