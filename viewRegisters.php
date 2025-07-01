<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php'); 
   $randomId = $_REQUEST['randomId'] && $_REQUEST['randomId'] != '' ? $_REQUEST['randomId'] : 0;
   $registerqry = "select * from tluk_registers  WHERE randomId = '".$randomId."'";
   $registerdata = $crud->getData($registerqry);

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
                  View Registers Data
                <?php } ?>
                <?php if ($_GET['type']=='edit') { ?>
                  Edit Registers Data
                <?php } ?>
                </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                    <?php if ($_GET['type']=='view') { ?>
                      View Registers Data
                    <?php } ?>
                    <?php if ($_GET['type']=='edit') { ?>
                      Edit Registers Data
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
                      
                       <div class="col-6">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="firstName" id="firstName" class="form-control" readonly value="<?php echo $registerdata[0]['firstName'] ?>">
                        </div>
                      </div>
                       <div class="col-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lastName" id="lastName" class="form-control" readonly value="<?php echo $registerdata[0]['lastName'] ?>">
                        </div>
                      </div>
                           <div class="col-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" id="email" class="form-control"  readonly value="<?php echo $registerdata[0]['email'] ?>">
                        </div>
                      </div>
                       <div class="col-6">
                        <div class="form-group">
                          <label>Mobile Number</label>
                          <input type="text" name="mobile" id="mobile" class="form-control"  readonly value="<?php echo $registerdata[0]['mobile'] ?>">
                          
                        </div>
                      </div>
                   

                    <?php } ?>
                  
                      <div class="col-6">
                      <button type="button" class="btn btn-danger" onclick="location.href = 'manageRegisters.php'">Cancel</button>
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

</html>