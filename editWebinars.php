<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $webinarqry = "select * from tluk_webinars  WHERE randomId = '".$randomId."'";
   $webinardata = $crud->getData($webinarqry);
    $main_image= str_replace('../', '', $webinardata[0]['main_image']);
    $home_image= str_replace('../', '', $webinardata[0]['home_image']);
   $image= str_replace('../', '', $webinardata[0]['image']);


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
                                    View Webinar
                                    <?php } ?>
                                    <?php if ($_GET['type']=='edit') { ?>
                                    Edit Webinar
                                    <?php } ?>
                                </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            <?php if ($_GET['type']=='view') { ?>
                                            View Webinar
                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>
                                            Edit Webinar
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
                                                    <label>Webinar Name</label>
                                                    <input type="text" name="webinar_name" id="webinar_name"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['webinar_name'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="date" name="date" id="date" class="form-control"
                                                        value="<?php echo $webinardata[0]['date'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <input type="time" name="start_time" id="start_time"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['start_time'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <input type="time" name="end_time" id="end_time"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['end_time'];?>" readonly>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Main Image</label><br>
                                                    <img src="<?php echo $main_image;?>" width="100"
                                                        style="border-radius: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Details Image</label><br>
                                                    <img src="<?php echo $home_image;?>" width="100"
                                                        style="border-radius: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Description1</label>
                                                    <textarea id="description1" name="description1" class="form-control"
                                                        readonly><?php echo $webinardata[0]['description1'];?></textarea>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Image1</label><br>
                                                    <img src="<?php echo $image;?>" width="100"
                                                        style="border-radius: 10px;">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Description2</label>
                                                    <textarea id="description2" name="description2" class="form-control"
                                                        readonly><?php echo $webinardata[0]['description2'];?></textarea>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Location </label>
                                                    <textarea id="webinar_location" name="webinar_location"
                                                        class="form-control"
                                                        readonly><?php echo $webinardata[0]['webinar_location'];?></textarea>
                                                </div>
                                            </div>


                                            <?php } ?>
                                            <?php if ($_GET['type']=='edit') { ?>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Name <span class="star">*</span></label>
                                                    <input type="text" name="webinar_name" id="webinar_name"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['webinar_name'];?>">

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Date <span class="star">*</span></label>
                                                    <input type="date" name="date" id="date" class="form-control"
                                                        value="<?php echo $webinardata[0]['date'];?>">

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Start Time <span class="star">*</span></label>
                                                    <input type="time" name="start_time" id="start_time"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['start_time'];?>">

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>End Time <span class="star">*</span></label>
                                                    <input type="time" name="end_time" id="end_time"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['end_time'];?>">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Main Image <span class="star">*</span></label>
                                                    <input type="file" name="main_image" id="main_image"
                                                        class="form-control image-upload" data-preview="#previewImage"
                                                        accept="image\*">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>800px × 600px</strong><br>
                                                        <input type="hidden" name="oldmain_image" id="oldmain_image"
                                                            class="form-control"
                                                            value="<?php echo $webinardata[0]['main_image'];?>">
                                                        <img src="<?php echo $main_image;?>" width="100"
                                                            style="border-radius: 10px; margin-top: 10px;">
                                                        <img id="previewImage"
                                                            style="display:none;border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Details Image <span class="star">*</span></label>
                                                    <input type="file" name="home_image" id="home_image"
                                                        class="form-control image-upload" data-preview="#previewImage2"
                                                        accept="image\*">
                                                    <p><br>
                                                        <input type="hidden" name="oldhome_image" id="oldhome_image"
                                                            class="form-control"
                                                            value="<?php echo $webinardata[0]['home_image'];?>">
                                                        <img src="<?php echo $home_image;?>" width="100"
                                                            style="border-radius: 10px; margin-top: 10px;">
                                                        <img id="previewImage2"
                                                            style="display:none;border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Description1 <span class="star">*</span></label>
                                                    <textarea id="description1" name="description1"
                                                        class="form-control"><?php echo $webinardata[0]['description1'];?></textarea>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Image1</label>
                                                    <input type="hidden" name="oldimage" id="oldimage"
                                                        class="form-control"
                                                        value="<?php echo $webinardata[0]['image'];?>">

                                                    <input type="file" name="image" id="image"
                                                        class="form-control image-upload" data-preview="#previewImage1"
                                                        accept="image\*">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>1600px × 1200px</strong><br>
                                                        <img src="<?php echo $image;?>" width="100"
                                                            style="border-radius: 10px; margin-top: 10px;">
                                                        <img id="previewImage1"
                                                            style="display:none;border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Description2 <span class="star">*</span></label>
                                                    <textarea id="description2" name="description2"
                                                        class="form-control"><?php echo $webinardata[0]['description2'];?></textarea>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Webinar Location <span class="star">*</span></label>
                                                    <textarea id="webinar_location" name="webinar_location"
                                                        class="form-control"><?php echo $webinardata[0]['webinar_location'];?></textarea>
                                                </div>
                                            </div>

                                            <?php } ?>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWebinars.php'">Cancel</button>
                                            </div>
                                            <?php if ($_GET['type'] == 'edit') { ?>
                                            <div class="col-6">
                                                <input type="hidden" name="hdn_id" id="hdn_id"
                                                    value="<?php echo $webinardata[0]['randomId']; ?>">
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
<script type="text/javascript" src="js/webinars.js"></script>

</html>