<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
  $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
  $logoqry = "select * from tluk_gallery  WHERE randomId = '".$randomId."'";
  $logodata = $crud->getData($logoqry);
 $headerlogo = str_replace('../', '', $logodata[0]['gallery_image']);


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
                  View Gallery
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Gallery
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Gallery
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Gallery
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
                          <label>Gallery Image</label><br>
                         <img src="<?php echo $headerlogo; ?>" width="100">
                        </div>
                      </div>
                      
                       
                      
                  
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
               
                    
                       <div class="col-12">
                        <div class="form-group">
                          <label>Gallery Image <span class="star">*</span></label>
                          <input type="file" name="header_logo" id="header_logo" class="form-control" >
                          <input type="hidden" name="oldheader_logo" id="oldheader_logo" class="form-control"  value="<?php echo $logodata[0]['gallery_image'];?>">
                          <img id="previewImage" src="#" alt="New Image Preview" style="display:none;" width="150" height="auto">
                          <img src="<?php echo $headerlogo;?>" width="100" style="border-radius: 10px;margin-top: 10px;">
                         
                        </div>
                      </div>
                      
                     
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageGallery.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $logodata[0]['randomId']; ?>">
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
<script type="text/javascript" src="js/gallery.js"></script>
</html>