<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
$seldata ="select * from tluk_categories";
$getdata = $crud->getData($seldata);?>


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
                <h4 class="mb-0 font-size-18">Add Business</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Add Business</li>
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
                          <label>Business Categories <span class="star"> *</span></label>
                          <select class="form-control" id="catg_id" name="catg_id">
                            <option value="">--select option--</option>
                            <?php foreach ($getdata  as $key => $value) { ?>
                              <option value="<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></option>
                            <?php } ?>
                          </select>
                          
                        </div>
                      </div>
                    <div class="col-12">
                        <div class="form-group">
                          <label>Business Title <span class="star"> *</span></label>
                          <input type="text" name="title" id="title" class="form-control">
                        </div>
                      </div>
                      
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Main Image <span class="star"> *</span></label>
                          <input type="file" name="main_image" id="main_image" class="form-control image-upload" data-preview="#previewImage" accept="image\*">
                          <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>800px × 600px</strong><br>
                          <img id="previewImage" style="display:none;border-radius: 10px; margin-top: 10px;" width="150" height="auto">
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Description <span class="star"> *</span></label>
                          <textarea id="description" name="description" class="form-control"></textarea>
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Discount </label>
                          <input type="text" name="discount" id="discount" class="form-control">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Address </label>
                          <textarea id="address" name="address" class="form-control"></textarea>
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business URL </label>
                          <input type="text" name="business_url" id="business_url" class="form-control" placeholder="https://www.example.com or www.example.com">
                         
                        </div>
                      </div>
                        <div class="col-4">
                        <div class="form-group">
                          <label>Business Social Account </label>
                          <input type="text" name="accounts" id="accounts" class="form-control">
                         
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <label>Business Social Account Link </label>
                          <input type="url" name="account_link" id="account_link" class="form-control">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Logo <span class="star"> *</span></label>
                          <input type="file" name="business_logo" id="business_logo" class="form-control image-upload" data-preview="#previewImage1" accept="image\*">
                          <img id="previewImage1" style="display:none;border-radius: 10px; margin-top: 10px;" width="150" height="auto">
                         
                        </div>
                      </div>
                      

                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageFeatureBusiness.php'">Cancel</button>
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

<script type="text/javascript" src="js/featurebusiness.js"></script>
</html>