<?php include('includes/header.php');
$selReg =$crud->getData("SELECT count(*)  as RegCount FROM `tluk_registers`");
$CountReg = $selReg[0]['RegCount'];
$selStory = $crud->getData("SELECT count(*) as storyCount FROM `tluk_stories`");
$CountStory =$selStory[0]['storyCount'];
$selEvents = $crud->getData("SELECT count(*) as eventCnt FROM `tluk_events` where status = 1");
$CountEvents =$selEvents[0]['eventCnt'];
$selWeb = $crud->getData("SELECT count(*) as WebCount FROM `tluk_webinars` where status = 1");
$CountWeb =$selWeb[0]['WebCount'];
$selFetBus = $crud->getData("SELECT count(*) as feaCnt FROM `tluk_featurebussines` where status = 1");
$CntBus =$selFetBus[0]['feaCnt'];
$selCategories = $crud->getData("SELECT count(*) as cnt FROM `tluk_categories` where status = 1");
$CntCat =$selCategories[0]['cnt'];
$selCategories = $crud->getData("SELECT count(*) as contactcnt FROM `tluk_contactUsers` where status = 1");
$contactcntCat =$selCategories[0]['contactcnt'];
$selCategories = $crud->getData("SELECT count(*) as subscribercnt FROM `tluk_subscribers` where status = 1");
$subscribercntCat =$selCategories[0]['subscribercnt'];
?>

<body>
    <!-- navbar -->
    <?php include('includes/navbar.php');?>
    <!--./navbar -->
    <!-- sidebar -->
    <?php include('includes/sidebar.php');?>
    <!-- ./sidebar -->

    <!-- main-content -->
    <div class="main-content">
        <!-- page-content -->
        <div class="page-content">
            <!-- container Fluid -->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">TLUK</li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- Main Content Display -->
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus fa-3x text-primary"></i>
                                    <div class="ml-3">
                                        <h5 class="card-title">Registered Users</h5>
                                        <p class="card-text">No.of Registers: <?php echo $CountReg; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus fa-3x text-primary"></i>
                                    <div class="ml-3">
                                        <h5 class="card-title">Contacted Users</h5>
                                        <p class="card-text">No.of Contacts: <?php echo $contactcntCat; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus fa-3x text-primary"></i>
                                    <div class="ml-3">
                                        <h5 class="card-title">Subscribered Users</h5>
                                        <p class="card-text">No.of Subscribers: <?php echo $subscribercntCat; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="manageStories.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book fa-3x text-primary"></i>
                                        <div class="ml-3">
                                            <h5 class="card-title">Stories</h5>
                                            <p class="card-text">No.of Stories: <?php echo $CountStory; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="manageEvents.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-calendar fa-3x text-primary" aria-hidden="true"></i>
                                        <div class="ml-3">
                                            <h5 class="card-title">Events</h5>
                                            <p class="card-text">No.of Events: <?php echo $CountEvents; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="manageWebinars.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-podcast text-primary fa-3x" aria-hidden="true"></i>
                                        <div class="ml-3">
                                            <h5 class="card-title">Webinars</h5>
                                            <p class="card-text">No.of Webinars: <?php echo $CountWeb ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="manageFeatureBusiness.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-building fa-3x text-primary"></i>
                                        <div class="ml-3">
                                            <h5 class="card-title">Featured Business</h5>
                                            <p class="card-text">No.of Business: <?php echo $CntBus; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="manageFeatureBusiness.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-list-alt fa-3x text-primary"></i>
                                        <div class="ml-3">
                                            <h5 class="card-title">Categories</h5>
                                            <p class="card-text">No.of Categories: <?php echo $CntCat; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- ./Main Content Display -->

            </div>
            <!-- ./container-fluid -->
        </div>
        <!-- ./page-content -->
        <!-- footer -->
        <?php include('includes/footer.php');?>
        <!-- ./footer -->
    </div>
    <!-- ./main-content -->
    <!-- Overlay-->
    <div class="menu-overlay"></div>
</body>

</html>