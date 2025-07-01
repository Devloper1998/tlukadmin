<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $sliderqry = "select * from tluk_slider  WHERE randomId = '".$randomId."'";
   $sliderdata = $crud->getData($sliderqry);
    $image = str_replace('../', '', $sliderdata[0]['image']);

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
                  View Slider
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Slider
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Slider
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Slider
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
                          <label>Image</label><br>
                         <!-- <img src="<?php echo $image;?>" width="100"> -->
                         <video src="<?php echo $image;?>"  style="border-radius: 10px;" width="250" controls></video>
                        </div>
                      </div>
                      
                      
                  
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
               
                    
                       <div class="col-12">
                        <div class="form-group">
                          <label>Slider Image <span class="star">*</span></label>
                          <input type="file" name="video" id="video" class="form-control" >
                          <input type="hidden" name="oldVideo" id="oldVideo" class="form-control"  value="<?php echo $sliderdata[0]['image'];?>">
                           <p><span style="color:red;">Note:</span> &nbsp;Please upload a video file (e.g., MP4, WebM)</p> <br>
                         <!--  <img id="previewImage" src="#" alt="New Image Preview" style="display:none;border-radius: 10px;" width="150" height="auto"> -->
                         <video id="previewVideo" style="display:none; border-radius: 10px; margin-top: 10px;" width="300" controls></video>
                         <video src="<?php echo $image;?>"  width="250" style="border-radius: 10px;" controls></video>

                         

                         
                        </div>
                      </div>
                      
                       
                     
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageSlider.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $sliderdata[0]['randomId']; ?>">
                        <button type="submit" id="save" class="btn btn-success float-right">Update</button>
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
<script type="text/javascript" src="js/slider.js"></script>
</html>