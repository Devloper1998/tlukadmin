<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
  $businessqry = "select tf.*,tf.randomId as rand ,tc.* from tluk_featurebussines as tf left join tluk_categories as tc on tc.id = tf.catg_id WHERE tf.randomId = '".$randomId."'";
   $businessdata = $crud->getData($businessqry);
   $main_image = str_replace('../', '', $businessdata[0]['main_image']);
   $business_logo = str_replace('../', '', $businessdata[0]['business_logo']);

   $seldata ="select * from tluk_categories";
   $getdata = $crud->getData($seldata);

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
                  View Business
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Business
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Business
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Business
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
                          <label>Business Categories <span class="star"> *</span></label>
                         <input type="text" name="catg_id" class="form-control" id="catg_id" value="<?php echo $businessdata[0]['category_name'] ?>" readonly>
                          
                        </div>
                      </div>
                          <div class="col-12">
                        <div class="form-group">
                          <label>Business Title</label>
                          <input type="text" name="title" id="title" class="form-control" value="<?php echo  $businessdata[0]['title']?>" readonly>
                         
                        </div>
                      </div>
                      
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Main Image</label>
                          <br>
                          <img src="<?php echo  $main_image?>" width="100" style="border-radius: 10px;margin-top: 10px;">
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Description</label>
                          <textarea id="description" name="description" class="form-control" readonly><?php echo  $businessdata[0]['description']?></textarea>
                         
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Business Discount</label>
                          <input type="text" name="discount" id="discount" class="form-control" readonly value="<?php echo  $businessdata[0]['discount']?>">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Address</label>
                          <textarea id="address" name="address" class="form-control" readonly><?php echo  $businessdata[0]['address']?></textarea>
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business URL</label>
                          <input type="text" name="business_url" id="business_url" class="form-control" readonly value="<?php echo  $businessdata[0]['business_url']?>">
                         
                        </div>
                      </div>
                        <div class="col-4">
                        <div class="form-group">
                          <label>Business Social Account</label>
                          <input type="text" name="accounts" id="accounts" class="form-control" readonly value="<?php echo  $businessdata[0]['accounts']?>"> 
                         
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <label>Business Social Account Link</label>
                          <input type="text" name="account_link" id="account_link" class="form-control" readonly value="<?php echo  $businessdata[0]['account_link']?>">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Logo</label>
                          <br>
                          <img src="<?php echo $business_logo; ?>" width="100" style="border-radius: 10px; margin-top: 10px;">
                         
                        </div>
                      </div>
                      
                  
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                        <div class="col-12">
                            <div class="form-group">
                              <label>Business Categories <span class="star"> *</span></label>
                              <select class="form-control" id="catg_id" name="catg_id">
                                <option value="">--select option--</option>
                                <?php foreach ($getdata as $key => $value) { ?>
                                  <option value="<?php echo $value['id'] ?>" 
                                    <?php if ($value['id'] == $businessdata[0]['catg_id']) { echo "selected"; } ?>>
                                    <?php echo $value['category_name'] ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>


                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Title</label>
                          <input type="text" name="title" id="title" class="form-control" value="<?php echo  $businessdata[0]['title']?>">
                         
                        </div>
                      </div>
                      
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Main Image</label>
                          <input type="file" name="main_image" id="main_image" class="form-control image-upload" data-preview="#previewImage" accept="image\*">
                          <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>800px × 600px</strong><br>
                          <img id="previewImage" style="display:none;border-radius: 10px; margin-top: 10px;" width="150" height="auto">
                          <input type="hidden" name="oldmain_image" id="oldmain_image" class="form-control" value="<?php echo  $businessdata[0]['main_image']?>?>">

                          <img src="<?php echo  $main_image;?>" width="100" style="border-radius: 10px;margin-top: 10px;">
                         
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Business Description</label>
                          <textarea id="description" name="description" class="form-control"><?php echo  $businessdata[0]['description']?></textarea>
                         
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Business Discount </label>
                          <input type="text" name="discount" id="discount" class="form-control" value="<?php echo  $businessdata[0]['discount']?>">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Address </label>
                          <textarea id="address" name="address" class="form-control"><?php echo  $businessdata[0]['address']?></textarea>
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business URL </label>
                          <input type="text" name="business_url" id="business_url" class="form-control" value="<?php echo  $businessdata[0]['business_url']?>">
                         
                        </div>
                      </div>
                        <div class="col-4">
                        <div class="form-group">
                          <label>Business Social Account </label>
                          <input type="text" name="accounts" id="accounts" class="form-control" value="<?php echo  $businessdata[0]['accounts']?>">
                         
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <label>Business Social Account Link </label>
                          <input type="url" name="account_link" id="account_link" class="form-control" value="<?php echo  $businessdata[0]['account_link']?>">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Business Logo <span class="star"> *</span></label>
                          <input type="file" name="business_logo" id="business_logo" class="form-control image-upload" data-preview="#previewImage1" accept="image\*">
                          <img id="previewImage1" style="display:none;border-radius: 10px; margin-top: 10px;" width="150" height="auto">
                          <input type="hidden" name="oldbusiness_logo" id="oldbusiness_logo" class="form-control" value="<?php echo  $businessdata[0]['business_logo'];?>">
                          <img src="<?php echo  $business_logo;?>" width="100" style="border-radius: 10px;margin-top: 10px;">
                         
                        </div>
                      </div>
                     
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageFeatureBusiness.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $businessdata[0]['rand']; ?>">
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
<script type="text/javascript" src="js/featurebusiness.js"></script>
</html>