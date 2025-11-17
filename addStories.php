<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');?>



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
                                <h4 class="mb-0 font-size-18">Add Stories</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add Stories</li>
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
                                    <form name="addformpage" id="addformpage" method="post"
                                        enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Title <span class="star">*</span></label>
                                                    <input type="text" name="title" id="title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Main Image <span class="star">*</span></label>
                                                    <input type="file" name="main_image" id="main_image"
                                                        class="form-control image-upload" data-preview="#previewImage"
                                                        accept="image\*">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>800px × 600px</strong><br>

                                                        <img id="previewImage"
                                                            style="display:none; border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div>
                                            <!--  <div class="col-12">
                        <div class="form-group">
                          <label>Date <span class="star">*</span></label>
                          <input type="date" name="date" id="date" class="form-control">
                         
                        </div>
                      </div> -->
                                            <!-- <div class="col-4">
                        <div class="form-group">
                          <label>Start Time <span class="star">*</span></label>
                          <input type="time" name="start_time" id="start_time" class="form-control">
                         
                        </div>
                      </div>
                       <div class="col-4">
                        <div class="form-group">
                          <label>End Time <span class="star">*</span></label>
                          <input type="time" name="end_time" id="end_time" class="form-control">
                         
                        </div>
                      </div> -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Author Profile Image <span class="star"></span></label>
                                                    <input type="file" name="profile_image" id="profile_image"
                                                        class="form-control image-upload" data-preview="#previewImage1"
                                                        accept="image\*">
                                                    <img id="previewImage1"
                                                        style="display:none; border-radius: 10px; margin-top: 10px;"
                                                        width="150" height="auto">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Author Name <span class="star">*</span></label>
                                                    <input type="text" name="name" id="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Category <span class="star"></span></label>
                                                    <textarea name="designation" id="designation"
                                                        class="form-control"></textarea>
                                                    <!-- <input type="text" name="designation" id="designation"
                                                        class="form-control"> -->
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Description1 <span class="star">*</span></label>
                                                    <textarea id="description1" name="description1"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Image1</label>
                                                    <input type="file" name="story_image1" id="story_image1"
                                                        class="form-control image-upload" data-preview="#previewImage2"
                                                        accept="image\*">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>1600px × 1200px</strong><br>
                                                        <img id="previewImage2"
                                                            style="display:none;border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div> -->
                                            <!-- <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Description2 <span class="star">*</span></label>
                                                    <textarea id="description2" name="description2"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-12">
                                                <div class="form-group">
                                                    <label>Story Image2</label>
                                                    <input type="file" name="story_image2" id="story_image2"
                                                        class="form-control image-upload" data-preview="#previewImage3"
                                                        accept="image\*">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>1600px × 1200px</strong><br>
                                                        <img id="previewImage3"
                                                            style="display:none;border-radius: 10px; margin-top: 10px;"
                                                            width="150" height="auto">

                                                </div>
                                            </div> -->
                                            <!--  <div class="col-12">
                        <div class="form-group">
                          <label>Description3</label>
                          <textarea id="description3" name="description3" class="form-control"></textarea>
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Description4</label>
                          <textarea id="description4" name="description4" class="form-control"></textarea>
                        </div>
                      </div> -->
                                            <!--   <div class="col-12">
                        <div class="form-group">
                          <label>More Images</label>
                          <input type="file" name="story_image[]" id="story_image" class="form-control" multiple>
                          <img id="previewImage2" src="#" alt="New Image Preview" style="display:none;" width="150" height="auto">

                        </div>
                        <p> <span style="color:red;font-weight: bold;">Note:</span>Upload Multiple Images </p>
                      </div> -->



                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageStories.php'">Cancel</button>
                                            </div>
                                            <div class="col-6">

                                                <input type="submit" name="submit" id="save" value="Save"
                                                    class="btn btn-primary float-right">
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

<script type="text/javascript" src="js/stories.js"></script>

</html>