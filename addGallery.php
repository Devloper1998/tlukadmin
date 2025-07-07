<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
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
                <h4 class="mb-0 font-size-18">Add Gallery</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Add Gallery</li>
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
                          <label>Image</label>
                          <input type="file" name="header_logo" id="header_logo" class="form-control">
                          <img id="previewImage" src="#" alt="New Image Preview" style="display:none;" width="150" height="auto">

                         
                        </div>
                      </div>
                
                      

                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageGallery.php'">Cancel</button>
                      </div>
                      <div class="col-6">
                        
                       <input type="submit" name="submit" value="Save" id="save" class="btn btn-primary float-right">
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

<script type="text/javascript" src="js/gallery.js"></script>
</html>