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
                <h4 class="mb-0 font-size-18">Categories</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="javascript: void(0);">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Categories</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end breadcrumb -->

          <!-- Page Content -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-6">
                      <h4 class="card-title">Categories Data Table</h4>
                    </div>
                     <div class="col-6">
                      <a href="addCategory.php" class="btn btn-primary float-right">Add Category</a>
                    </div>
                  </div>
                  
                  <table id="Form_Table" class="table dt-responsive nowrap">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                       
                        <th>Actions</th>
                      </tr>
                    </thead>
                  </table>

                </div>
              </div>
            </div>
          </div>
          <!-- End Page Content -->

        </div>
      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>

</body>
<script type="text/javascript" src="js/category.js"></script>
</html>