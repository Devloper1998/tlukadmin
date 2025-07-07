<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
 
   $contactqry = "select * from tluk_contactUsers  WHERE randomId = '".$randomId."'";
   $contactUserdata = $crud->getData($contactqry);

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
                  View Event
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Event
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Event
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Event
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
                          <label>Name</label>
                          <input type="text" name="name" id="name" class="form-control" value="<?php echo $contactUserdata[0]['name'];?>" readonly>
                         
                        </div>
                      </div>
                       <div class="col-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" id="email" class="form-control" value="<?php echo $contactUserdata[0]['email'];?>" readonly>
                         
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Phone Number</label>
                          <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $contactUserdata[0]['phone'];?>" readonly>
                         
                        </div>
                      </div>
                    
                       
                       
                      <div class="col-12">
                        <div class="form-group">
                          <label>Message</label>
                          <textarea id="message" name="message" class="form-control" readonly><?php echo $contactUserdata[0]['message'];?></textarea>
                         
                        </div>
                      </div>
                      
                  
                    <?php } ?>
                    
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageContactUsers.php'">Cancel</button>
                      </div>
                      <?php if ($_GET['type'] == 'edit') { ?>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $contactUserdata[0]['randomId']; ?>">
                        <button type="submit" class="btn btn-success float-right">Update</button>
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
<script type="text/javascript" src="js/events.js"></script>
</html>