<?php 
$select = "select * from tluk_logo";
$getlogo= $crud->getData($select);
$logo = str_replace('../', '', $getlogo[0]['header_logo']);

 ?>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="home.php" class="logo1">
                <img src="<?php echo $logo; ?>" width="200">
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="home.php" class=" waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Home</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageLogo.php"><i class="fa fa-globe" aria-hidden="true"></i>Site Logo</a></li>
                        <li><a href="manageSocialicons.php"><i class="fa fa-envelope"></i>Social Icons</a></li>
                        <li><a href="manageSlider.php"><i class="fa fa-picture-o" aria-hidden="true"></i> Slider</a>
                        </li>
                        <li><a href="managetluk.php"><i class="fa fa-info-circle" aria-hidden="true"></i> What is
                                TLUK</a></li>
                        <li><a href="manageOurImpact.php"><i class="fa fa-line-chart" aria-hidden="true"></i> Our
                                Impact</a></li>
                        <li><a href="manageWhyjoin.php"><i class="fa fa-users" aria-hidden="true"></i> Why Join us?</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageAbout.php"><i class="fa fa-info-circle" aria-hidden="true"></i>About</a></li>
                        <li><a href="manageOurMission.php"><i class="fa fa-bullseye" aria-hidden="true"></i> Our
                                Mission</a></li>
                        <li><a href="manageSupport.php"><i class="fa fa-handshake-o" aria-hidden="true"></i> Support &
                                Guidance</a></li>
                        <li><a href="manageConnection.php"><i class="fa fa-globe" aria-hidden="true"></i> Cultural
                                Connection</a></li>
                        <li><a href="manageCommunity.php"><i class="fa fa-comments" aria-hidden="true"></i> Community
                                Circles</a></li>
                        <li><a href="manageEmpowerment.php"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                                Empowerment & Growth</a></li>
                        <li><a href="manageGallery.php"><i class="fa fa-picture-o" aria-hidden="true"></i>Gallery</a>
                        </li>
                        <li><a href="manageContact.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <span>Stories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageStoryDesc.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Story
                                Description</a></li>
                        <li><a href="manageStories.php"><i class="fa fa-book" aria-hidden="true"></i> Add Stories</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageEventDesc.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Event
                                Description</a></li>
                        <li><a href="manageEvents.php"><i class="fa fa-calendar" aria-hidden="true"></i> Add Events</a>
                        </li>
                        <li><a href="manageEventCategory.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Event
                                Category</a>
                        </li>
                        <li><a href="manageSponsors.php"><i class="fa fa-calendar" aria-hidden="true"></i> Event
                                Sponsors</a>
                        </li>
                        <li><a href="manageWinners.php"><i class="fa fa-trophy" aria-hidden="true"></i> Event
                                Winners</a>
                        </li>

                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-podcast" aria-hidden="true"></i>
                        <span>Webinars</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageWebinarDesc.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Webinar
                                Description</a></li>
                        <li><a href="manageWebinars.php"><i class="fa fa-podcast" aria-hidden="true"></i> Add
                                Webinars</a></li>
                    </ul>

                </li>
                <li>
                    <a href="manageCategories.php" class=" waves-effect">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span>Featured Business</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="manageFeatureDesc.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Business
                                Description</a></li>
                        <li><a href="manageFeatureBusiness.php"><i class="fa fa-building" aria-hidden="true"></i> Add
                                Business</a></li>
                        <li><a href="manageFeaturedBusiness.php"><i class="fa fa-building" aria-hidden="true"></i>
                                Featured Businesses</a></li>
                        <li><a href="manageNonfeaturedBusiness.php"><i class="fa fa-building" aria-hidden="true"></i>
                                Non Featured Businesses</a></li>
                    </ul>

                </li>
                <!-- <li>
                            <a href="manageBusinesses.php" class=" waves-effect">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <span>Non Featured Business</span>
                            </a>
                        </li> -->


                <!-- <li>
                            <a href="manageRegisters.php" class=" waves-effect">
                            <i class="fas fa-users"></i>
                            <span>Registration form-entries</span>
                            </a>
                        </li> -->
                <li>
                    <a href="manageContactUsers.php" class=" waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Contact form-entries</span>
                    </a>
                </li>

                <li>
                    <a href="manageSubscribers.php" class=" waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Subscribers form-entries</span>
                    </a>
                </li>


                <li>
                    <a href="logout.php" class=" waves-effect">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->