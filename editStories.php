<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $res_qry = "select * from tluk_stories  WHERE randomId = '".$randomId."'";
   $res_data = $crud->getData($res_qry);

   $id = $res_data[0]['id'];
   $main_image = str_replace('../', '', $res_data[0]['main_image']);
   $profile_image = str_replace('../', '', $res_data[0]['profile_image']);
   $story_image1 = str_replace('../', '', $res_data[0]['story_image1']);
   $story_image2 = str_replace('../', '', $res_data[0]['story_image2']);

   // $storyqry ="select * from tluk_story_images where story_id ='".$id."'";
   // $storydata = $crud->getData($storyqry);

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
                  View Stories
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Stories
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Stories
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Stories
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
                          <label>Story Title</label> 
                         <input type="text" name="title" id="title" class="form-control" value="<?php echo $res_data[0]['title']?>" readonly>
                        </div> 
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Main Image</label><br>
                          <img src="<?php echo $main_image?>" width="100" height="auto" style="border-radius: 10px;">
                        </div>
                      </div>
                     <!--  <div class="col-6">
                        <div class="form-group">
                          <label>Date</label>
                          <input type="date" name="date" id="date" class="form-control" value="<?php //echo $res_data[0]['date'] ?>" readonly>
                         
                        </div>
                      </div> -->
                      <!-- <div class="col-4">
                        <div class="form-group">
                          <label>Start Time</label>
                          <input type="time" name="start_time" id="start_time" class="form-control" value="<?php //echo $res_data[0]['start_time'] ?>" readonly>
                         
                        </div>
                      </div>
                       <div class="col-4">
                        <div class="form-group">
                          <label>End Time</label>
                          <input type="time" name="end_time" id="end_time" class="form-control" value="<?php //echo $res_data[0]['end_time'] ?>" readonly>
                         
                        </div>
                      </div> -->
                      <div class="col-12">
                        <div class="form-group">
                          <label>Author Profile Image</label><br>
                          <img src="<?php echo $profile_image?>" width="100" height="auto" style="border-radius: 10px;">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Author Name</label>
                          <input type="text" name="name" id="name" class="form-control" value="<?php echo $res_data[0]['name']?>" readonly>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Category</label>
                          <input type="text" name="designation" id="designation" class="form-control" value="<?php echo $res_data[0]['designation']?>" readonly>
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Description1</label>
                          <textarea id="description1" name="description1" class="form-control" readonly><?php echo $res_data[0]['description1']?></textarea>
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Image1</label><br>
                          <img src="<?php echo $story_image1;?>" width="100" height="auto" style="border-radius: 10px;">&ensp;

                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Description2</label>
                          <textarea id="description2" name="description2" class="form-control" readonly><?php echo $res_data[0]['description2']?></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Story Image2</label><br>
                          <img src="<?php echo $story_image2;?>" width="100" height="auto" style="border-radius: 10px;">&ensp;

                        </div>
                      </div>
                     
                       <!--  <div class="col-12">
                        <div class="form-group">
                          <label>More Images</label>
                          <br>
                          <?php //foreach ($storydata as $key => $value) { ?>
                           <img src="tlukadmin/<?php //echo $value['story_image']?>" width="100">&ensp;
                          <?php // } ?>
                         
                         
                        </div>
                        <p> <span style="color:red;font-weight: bold;">Note:</span>Upload Multiple Images </p>
                      </div> -->
                   

                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                        
                    
                       
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Title <span class="star">*</span></label>
                         <input type="text" name="title" id="title" class="form-control" value="<?php echo $res_data[0]['title'] ?>">
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Main Image <span class="star">*</span></label>
                          <input type="file" name="main_image" id="main_image" class="form-control image-upload" data-preview="#previewImage" accept="image\*">
                          <input type="hidden" name="oldmain_image" id="oldmain_image" class="form-control" value="<?php echo $res_data[0]['main_image'] ?>" >
                          <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>800px × 600px</strong><br>
                          <img id="previewImage" src="#" alt="New Image Preview" style="display: none;border-radius: 10px; margin-top: 10px;" width="150" height="auto">
                          <br>
                          <img src="<?php echo $main_image?>" width="100" style="border-radius: 10px; margin-top: 10px;">

                        </div>
                      </div>
                      <!-- <div class="col-4">
                        <div class="form-group">
                          <label>Date <span class="star">*</span></label>
                          <input type="date" name="date" id="date" class="form-control" value="<?php //echo $res_data[0]['date'] ?>" >
                         
                        </div>
                      </div> -->
                     <!--  <div class="col-4">
                        <div class="form-group">
                          <label>Start Time <span class="star">*</span></label>
                          <input type="time" name="start_time" id="start_time" class="form-control" value="<?php //echo $res_data[0]['start_time'] ?>" >
                         
                        </div>
                      </div>
                       <div class="col-4">
                        <div class="form-group">
                          <label>End Time <span class="star">*</span></label>
                          <input type="time" name="end_time" id="end_time" class="form-control" value="<?php //echo $res_data[0]['end_time'] ?>" >
                         
                        </div>
                      </div> -->
                      <div class="col-12">
                        <div class="form-group">
                          <label>Author Profile Image <span class="star"></span></label>
                          <input type="file" name="profile_image" id="profile_image" class="form-control image-upload" data-preview="#previewImage1" accept="image\*" >
                           <input type="hidden" name="oldprofile_image" id="oldprofile_image" class="form-control" value="<?php echo $res_data[0]['profile_image'] ?>" >
                          <img id="previewImage1" src="#" alt="New Image Preview" style="display: none;border-radius: 10px; margin-top: 10px" width="150" height="auto">
                          <br>
                          <img src="<?php echo $profile_image?>" width="100" style="border-radius: 10px; margin-top: 10px;">

                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Author Name <span class="star">*</span></label>
                          <input type="text" name="name" id="name" class="form-control" value="<?php echo $res_data[0]['name'] ?>">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Category <span class="star"></span></label>
                          <input type="text" name="designation" id="designation" class="form-control" value="<?php echo $res_data[0]['designation'] ?>" >
                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Description1 <span class="star">*</span></label>
                          <textarea id="description1" name="description1" class="form-control"><?php echo $res_data[0]['description1'] ?></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Story Image1</label>
                          <input type="file" name="story_image1" id="story_image1" class="form-control image-upload" data-preview="#previewImage2" accept="image\*">
                           <input type="hidden" name="oldstory_image1" id="oldstory_image1" class="form-control" value="<?php echo $res_data[0]['story_image1'] ?>" >
                           <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>1600px × 1200px</strong><br>
                          <img id="previewImage2" style="display:none;border-radius: 10px; margin-top: 10px; margin-top: 10px;" width="150" height="auto">
                          <img src="<?php echo $story_image1;?>" width="100" style="border-radius: 10px; margin-top: 10px;">
                         <!--  <br>
                          <a href="" onclick="deleteImage()"><i class="fa fa-trash" style="color:red;font-size: 20px; margin-left:35px;"></i></a> -->

                        </div>
                      </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label>Story Description2 <span class="star">*</span></label>
                          <textarea id="description2" name="description2" class="form-control"><?php echo $res_data[0]['description2'] ?></textarea>
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Story Image2</label>
                          <input type="file" name="story_image2" id="story_image2" class="form-control image-upload" data-preview="#previewImage3" accept="image\*">
                           <input type="hidden" name="oldstory_image2" id="oldstory_image2" class="form-control" value="<?php echo $res_data[0]['story_image2'] ?>" >
                           <p><span style="color:red;">Note:</span> &nbsp;Please upload an image with dimensions <strong>1600px × 1200px</strong><br>
                          <img id="previewImage3" style="display:none;border-radius: 10px; margin-top: 10px; margin-top: 10px;" width="150" height="auto">
                          <img src="<?php echo $story_image2 ;?>" width="100" style="border-radius: 10px; margin-top: 10px;">

                        </div>
                      </div>
                 
                       <!--  <div class="col-12">
                        <div class="form-group">
                          <label>More Images</label>
                          <input type="file" name="story_image[]" id="story_image" class="form-control" multiple>
                          <img id="previewImage2" src="#" alt="New Image Preview" style="display:none;" width="150" height="auto">
                          <br>
                          <?php //foreach ($storydata as $key => $value) { ?>
                           <img src="tlukadmin/<?php //echo $value['story_image']?>" width="100">&ensp;
                          <a href="javascript:void(0)" title="Delete" onclick="DelImg(<?php //echo $value['id']; ?>)"><i class="fas fa-trash fa-lg text-danger my-2"></i></a>
                          <input type="hidden" name="oldImage[]" id="oldImage" class="form-control" value="<?php //echo $value['story_image'] ?>">
                          <input type="hidden" name="hid_storyid[]" id="hid_storyid" class="form-control" value="<?php //echo $value['story_id'] ?>">

                          <?php //} ?>


                        </div>
                        <p> <span style="color:red;font-weight: bold;">Note:</span>Upload Multiple Images </p>
                      </div> -->
                     
                    <?php } ?>
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageStories.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $res_data[0]['randomId']; ?>">
                        
                        <button type="submit" class="btn btn-success float-right" id="save">Update</button>
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
<script type="text/javascript" src="js/stories.js"></script>

</html>