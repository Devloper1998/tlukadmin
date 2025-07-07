<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
 $aboutqry = "select * from tluk_about";
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
                <h4 class="mb-0 font-size-18">Manage About</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage About</li>
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
                          <label>About Description <span class="star">*</span></label>
                          <textarea class="form-control" name="description" id="description" cols="5" rows="5"><?php echo $aboutdata[0]['description']; ?></textarea>

                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>About Image <span class="star">*</span></label>
                          <input type="file" name="image" id="image" class="form-control" value="<?php echo $aboutdata[0]['image'] ?>" accept="image\*">
                          <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>900px × 572px</strong><br>
                          <img id="previewImage" src="#" alt="New Image Preview" style="border-radius: 10px;display:none;" width="150" height="auto">

                          <img src="<?php echo $image; ?>" width="150" height="auto" style="border-radius: 10px;margin-top: 10px;">

                           <input type="hidden" name="oldImage" id="oldImage" class="form-control" value="<?php echo $aboutdata[0]['image'] ?>">
                        </div>
                      </div>
                    

                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageAbout.php'">Cancel</button>
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

<script type="text/javascript" src="js/about.js"></script>
</html>