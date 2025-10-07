<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
$selEvent = "select * from tluk_events";
$getEvents  = $crud->getData($selEvent);
$selSponsor = "select * from tluk_sponsors";
$getSponsor = $crud->getData($selSponsor);
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
                                <h4 class="mb-0 font-size-18">Add Winners</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="home.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add Winners</li>
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
                                                    <label>Winner Name <span class="star">*</span></label>
                                                    <input type="text" name="winner_name" id="winner_name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Event Name <span class="star">*</span></label>
                                                    <select name="event_name" id="event_name" class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getEvents as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['event_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sponsor Name <span class="star">*</span></label>
                                                    <select name="sponsor_name" id="sponsor_name" class="form-control">
                                                        <option value="">--select option--</option>
                                                        <?php foreach ($getSponsor as $key => $value) { ?>
                                                        <option value="<?php echo $value['id'] ?>">
                                                            <?php echo $value['sponsor_name']?></option>
                                                        <?php
                                                    }?>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="location.href = 'manageWinners.php'">Cancel</button>
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

<script type="text/javascript" src="js/winner.js"></script>

</html>