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
                <h4 class="mb-0 font-size-18">Add Slider</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Add Slider</li>
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
                          <label>Slider Image <span class="star">*</span></label>
                          <input type="file" name="video" id="video" class="form-control" accept="video/*">
                          <video id="previewVideo" style="display:none; border-radius: 10px; margin-top: 10px;" width="300" controls></video>
                           <p><span style="color:red;">Note:</span> &nbsp;Please upload a video file (e.g., MP4, WebM)</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageSlider.php'">Cancel</button>
                      </div>
                      <div class="col-6">
                        
                       <input type="submit" name="submit" id="save" value="Save" class="btn btn-primary float-right">
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

<script type="text/javascript" src="js/slider.js"></script>
</html>