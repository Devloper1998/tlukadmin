<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
 $aboutqry = "select * from tluk_webinardescription";
 $aboutdata = $crud->getData($aboutqry);
 $image = str_replace('../', '', $aboutdata[0]['image']);

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
                <h4 class="mb-0 font-size-18">Manage Webinar Description</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Webinar Description</li>
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
                  <!-- <h4 class="card-title">Add Product</h4> -->
                  <form name="addformpage" id="addformpage" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                          <label>Webinar Description <span class="star">*</span></label>
                          <textarea class="form-control" name="webinar_description" id="webinar_description" cols="5" rows="5"><?php echo $aboutdata[0]['webinar_description']; ?></textarea>

                         
                        </div>
                      </div>
                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageWebinarDesc.php'">Cancel</button>
                      </div>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $aboutdata[0]['randomId']?>">
                       <input type="submit" name="submit"  id="save" value="Update" class="btn btn-primary float-right">
                      </div>
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

<script type="text/javascript" src="js/webinardesc.js"></script>
</html>