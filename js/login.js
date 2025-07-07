function validation() {
    let username = $('#username').val();
    let password = $('#password').val();

    if(username == ''){
      toastr.error("Enter Email...");
      $('#username').focus();
      return false;
    }else if(password == ''){
      toastr.error("Enter PassWord...");
      $('#password').focus();
      return false;
    }else{
      return true;
    }
  }
  
  function loginval(){
    if(validation()){
      let username = $('#username').val();
      let password = $('#password').val();
    
    $.ajax({
        url : 'actions/savelogins.php',
        type : 'POST',
        data : {'action' : 'login','username' : username, 'password' : password},
        success : function(data){
          console.log(data);         
            if (data == "true"){
              
              toastr.success("Login successfully...!");
              setTimeout(function(){
              window.location.href = "home.php";},
              1000);
               
            }
            else{
              toastr.error('invalid logins');
            }
        }
    });
    }
  }
$(document).ready(function(){
  $(document).on('keydown', function(e){
    if(e.keyCode == 13){ 
      loginval();
    }
  });
});
