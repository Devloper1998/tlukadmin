<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $categoryqry = "select * from tluk_categories  WHERE randomId = '".$randomId."'";
   $categorydata = $crud->getData($categoryqry);
   

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
                  View Category
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Category
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Category
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Category
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
                          <label>Event Name</label>
                          <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo $categorydata[0]['category_name'];?>" readonly>
                         
                        </div>
                      </div>
                       
                      
                  
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
               
                    
                        <div class="col-12">
                        <div class="form-group">
                          <label>Event Name</label>
                          <input type="text" name="category_name" id="category_name" class="form-control"  value="<?php echo $categorydata[0]['category_name'];?>">
                         
                        </div>
                      </div>
                       
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageCategories.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $categorydata[0]['randomId']; ?>">
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
<script type="text/javascript" src="js/category.js"></script>
</html>