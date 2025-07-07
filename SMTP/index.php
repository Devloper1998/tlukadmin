<!DOCTYPE html>
<html lang="en">
<head>
  <title>MIND AVENUES</title>
  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="vendors/vendors/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="LOGO2.png">
  <link rel="icon" type="image/png" sizes="16x16" href="LOGO2.png">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="vendors/vendors/styles/core.css">
  <link rel="stylesheet" type="text/css" href="vendors/vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendors/vendors/styles/style.css">

  <!-- toastr -->
  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">



  <!-- <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script> -->

  <style type="text/css">
               
           .btn-grads {
            background-image: linear-gradient(to right, #26a0da 0%, #F10E0E  51%, #26a0da  100%);
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }
          .form-control{
            background-color:#e6e6e6 ;
          }
          span{
          	font-weight: bold;
          }


  </style>
</head>
<body>

<div class="container">
  <form name="addformpage" id="addformpage"  autocomplete="off" method="post" enctype="multipart/form-data">
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

        	<div class="row justify-content-center">
            <div class="col-md-1"></div>
        	 <div class="col-md-10" >
            <h4 class="text-center">Welcome to Mind Avenues</h4>
            <img src="LOGO2.png" style="width: 100%; height:200px; object-fit: contain;">
            <div>
            <input type="text" name="Name" id="Name" placeholder="Name" class="form-control mb-3">
            <span id="s1" class="error"></span>
            </div>
            <div>
            <input type="email" name="email" id="email" placeholder="Email" class="form-control mb-3">
            <span id="s2" class="error"></span>
            </div>
            <div>
            <input type="text" name="contact" id="contact" class="form-control mb-3" placeholder="Phone Number">
            <span id="s3" class="error"></span>
            </div>
            <input type="button" name="submit" class="btn btn-grads form-control mb-4" value="Let's Connect" onclick="save()">
            </div>
            <div class="col-md-1"></div>
        	</div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- js -->
  <script src="vendors/vendors/scripts/core.js"></script>
  <script src="vendors/vendors/scripts/script.min.js"></script>
  <script src="vendors/vendors/scripts/process.js"></script>
  <script src="vendors/vendors/scripts/layout-settings.js"></script>
</body>
</html>
<!-- toaster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
    
function existing(){
/*  alert("df")*/
 $("#myModal").hide();
$('#existingModel').modal('show');
}
function backmodel() {
$("#existingModel").hide();
location.reload();
}

 function save(){

  let Name    = $('#Name').val().trim();
  let email   = $('#email').val().trim();
  let contact = $('#contact').val().trim();
  
   if(Name==''){ 
        $('#s1').html('Please Enter Name'); 
        $('#Name').focus(); 
        return false; 

    }else if(email==''){ 
        $('#s2').html('Please Enter Email'); 
        $('#email').focus(); 
        return false; 

    }else if(contact==''){ 
        $('#s3').html('Please Enter Contact Number'); 
        $('#contact').focus(); 
        return false; 

    }
    else{ 
       let arr = [];
       let formData = new FormData();
      formData.append('Name', $('#Name').val());
      formData.append('email', $('#email').val());
      formData.append('contact', $('#contact').val());

      formData.append('action', 'save'); 
         $.ajax({
        url : 'saveconnectdetails.php',
        type : 'POST',
        data : formData,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
          // console.log(data);
            if (data.trim() == 'true'){
              toastr.success("Saved successfully...!");
              setTimeout(function (){
               location.reload();
              },1000);
            }
            else{
              toastr.error('error');
            }
        }
    });

    }
  }


</script>


