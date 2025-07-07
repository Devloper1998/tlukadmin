<!DOCTYPE html>
<html lang="en">

<?php include('includes/header.php');
 $contactqry = "select * from tluk_contact";
 $contactdata = $crud->getData($contactqry);
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
                <h4 class="mb-0 font-size-18">Manage Contact</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                     <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Contact</li>
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
                  <form name="addformpage" id="addformpage" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                          <label>Contact Address <span class="star">*</span></label>
                          <textarea class="form-control" name="address" id="address" cols="5" rows="5"><?php echo $contactdata[0]['address'] ?></textarea>
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Contact Phone Number</label>
                          <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $contactdata[0]['mobile'] ?>">
                         
                        </div>
                      </div>
                        <div class="col-12">
                        <div class="form-group">
                          <label>Contact Email <span class="star">*</span></label>
                          <input type="email" name="email" id="email" class="form-control" value="<?php echo $contactdata[0]['email'] ?>">
                         
                        </div>
                      </div>
                      
                    

                      <div class="col-6">
                        <button type="button" class="btn btn-danger" onclick="location.href = 'manageAbout.php'">Cancel</button>
                      </div>
                      <div class="col-6">
                        <input type="hidden" name="hdn_id" id="hdn_id" value="<?php echo $contactdata[0]['randomId']?>">
                       <input type="submit" name="submit" value="Update" class="btn btn-primary float-right">
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

<script type="text/javascript">

 
$(function() {

  
  $("form[name='addformpage']").validate({

      rules: {        
      address          : "required",
      email          : "required",
    
     
    },

    messages: {         
      address          : "Please Enter Address ",
      email          : "Please Enter Email",
    
      
    },
  
    submitHandler: function(form) {
        let formdata = new FormData();
        
        let x = $('#addformpage').serializeArray();
        $.each(x, function(i, field){

          formdata.append(field.name, field.value);
        
          
        });
        formdata.append('action' , 'update'); 
        

        $.ajax({
          type: "POST",
          url: "actions/saveContact.php",
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: formdata,
          success: function (data) {
            if (data.trim() == 'true'){
              toastr.success('Updated Successfully...!');
              setTimeout(function (){
                location.href = "manageContact.php";
              },1000);
            }
            else{
              toastr.error(data);
            }
          }
        });
      }
  });
});


</script>
</html>