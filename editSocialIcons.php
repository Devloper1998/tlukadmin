<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $iconsqry = "select * from tluk_icons  WHERE randomId = '".$randomId."'";
   $iconsdata = $crud->getData($iconsqry);

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
                  View Social Icons
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Social Icons
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Social Icons
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Social Icons
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
                          <label>Social Account Name</label>
                          <input type="text" name="title" id="title" class="form-control" value="<?php echo $iconsdata[0]['title']?>" readonly>  
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Social URL</label>
                          <input type="url" name="link" id="link" class="form-control" value="<?php echo $iconsdata[0]['link']?>" readonly>
                         
                        </div>
                      </div>
                      
                  
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
               
                    
                          <div class="col-12">
                        <div class="form-group">
                          <label>Socail Account Name</label>
                          <input type="text" name="title" id="title" class="form-control" value="<?php echo $iconsdata[0]['title']?>"readonly>
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Social URL <span class="star">*</span></label>
                          <input type="url" name="link" id="link" class="form-control" value="<?php echo $iconsdata[0]['link']?>">
                         
                        </div>
                      </div>
                     
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageSocialicons.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $iconsdata[0]['randomId']; ?>">
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
<script type="text/javascript" src="js/socialicons.js"></script>
</html>