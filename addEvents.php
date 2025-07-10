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
                                <h4 class="mb-0 font-size-18">Add Event</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add Event</li>
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
                                                    <label>Event Name <span class="star">*</span></label>
                                                    <input type="text" name="event_name" id="event_name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Date <span class="star">*</span></label>
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>End Date <span class="star">*</span></label>
                                                    <input type="date" name="end_date" id="end_date"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Start Time <span class="star">*</span></label>
                                                    <input type="time" name="start_time" id="start_time"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>End Time <span class="star">*</span></label>
                                                    <input type="time" name="end_time" id="end_time"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Main Image <span class="star">*</span></label>
                                                    <input type="file" name="main_image" id="main_image"
                                                        class="form-control image-upload" data-preview="#previewImage"
                                                        accept="image\* ">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>800px × 600px</strong><br>
                                                        <img id="previewImage" src="#" alt="New Image Preview"
                                                            style="display:none;border-radius: 10px;" width="150"
                                                            height="auto">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Details Image <span class="star">*</span></label>
                                                    <input type="file" name="home_image" id="home_image"
                                                        class="form-control image-upload" data-preview="#previewImage2"
                                                        accept="image\* ">
                                                    <p><br>
                                                        <img id="previewImage2" src="#" alt="New Image Preview"
                                                            style="display:none;border-radius: 10px;" width="150"
                                                            height="auto">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Description1 <span class="star">*</span></label>
                                                    <textarea id="description1" name="description1"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Image1</label>
                                                    <input type="file" name="image" id="image"
                                                        class="form-control image-upload" data-preview="#previewImage1"
                                                        accept="image\*  ">
                                                    <p><span style="color:red;">Note:</span> &nbsp;Please upload an
                                                        image with dimensions <strong>1600px × 1200px</strong><br>
                                                        <img id="previewImage1" src="#" alt="New Image Preview"
                                                            style="display:none;border-radius: 10px;" width="150"
                                                            height="auto">
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Description2 <span class="star">*</span></label>
                                                    <textarea id="description2" name="description2"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Location <span class="star">*</span></label>
                                                    <textarea id="event_location" name="event_location"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageEvents.php'">Cancel</button>
                                            </div>
                                            <div class="col-6">

                                                <input type="submit" name="submit" value="Save" id="save"
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

<script type="text/javascript" src="js/events.js"></script>

</html>