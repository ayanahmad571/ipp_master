<?php
require_once("server_fundamentals/Settings.php");
require_once("server_fundamentals/CookieController.php");
require_once("server_fundamentals/DatabaseConnection.php");
require_once("server_fundamentals/FunctionsController.php");
sec_session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Signup - <?php echo BRANDING_COMPANY_NAME ?> ERP</title>
  
  <!-- Favicon -->
  <link rel="icon" 
      type="image/png" 
      href="<?php echo BRANDING_COMPANY_LOGO_FAVICON ?>">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?php echo BRANDING_COMPANY_LOGO_FAVICON ?>" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register a User </h4></div>
<style>
.successTick{
	color:green;
	font-size:10em;
	border-radius:0.4em;
}
</style>
              <div id="card-cont" class="card-body">
              <div class="col-12" align="center">
                  <img id="loader" style="margin:auto; display:none" src="assets/img/loader.gif" width="300px" />
              </div>
                <form id="signupForm" method="POST" action="server_fundamentals/RegisterController">
                <p>
                Note: A user account Registration is subject to approval.
                </p>
                  	<div id="signupFail" class="mb-4" style="display:none; background-color:rgba(255,195,196,0.3); color:rgba(255,16,16,1.00); padding:10px; border-radius:8px;">
                    	
                    </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="first_name">Name</label>
                      <input id="first_name" type="text" class="form-control" name="user_name" autofocus required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2" required>
                    </div>
                  </div>

                  <div class="form-divider">
                    User Advanced
                  </div>

                  <div class="form-group">
                    <label for="user_code">Code</label>
                    <input id="user_code" type="text" class="form-control" name="user_code" required>
                  </div>


                  <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select id="user_type" class="form-control" name="user_type" required>
                    	<?php
						$getInd = mysqlSelect("SELECT * FROM `user_types` ");
						if(is_array($getInd)){
							foreach($getInd as $ind){
								?>
								<option value="<?php echo $ind['user_type_id'] ?>"><?php echo $ind['user_type_name'] ?></option>
								<?php
							}
						}
						?>
                    </select>
                    <div class="invalid-feedback">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input required type="checkbox" name="agree" class="custom-control-input" id="agree" value="1">
                      <label class="custom-control-label" for="agree">I agree with the <a target="_blank" href="terms-of-service">terms of service</a></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              <div class="mt-3 mb-1 text-left">
                Already have an account? <a href="login">Sign In</a>
              </div>
            <div class="text-center mt-2 text-small">
              Powered by Aethn Aega, Theme by Stisla.
              <div class="mt-2">
                <a href="privacy-policy">Privacy Policy</a>
                <div class="bullet"></div>
                <a href="terms-of-service">Terms of Service</a>
              </div>
            </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/jquery.min.js" ></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Page Specific JS File -->
<script>
$(document).ready(function (e) {


    $('#signupForm').on('submit',(function(e) {
        e.preventDefault();
		$("#loader").fadeIn();
		$("#signupForm").fadeOut();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
				if(data.trim() == "ok"){
							$("#loader").fadeOut();
						$("#card-cont").html(
					"<div class=''>" + 
						" <div class='text-center'>" + 
							"<h1 class='successTick'><i class='fa fa-check'></i></h1>" +
							"<h6 align='center'>Your account has been sent for approval.</h6><br><br>" +
							"<a class='mt-2' href='login'><button class='btn btn-warning'>Go to Home Page..</button></a>" +					
						"</div>" +
					"</div>");
				}else{
					$("#loader").fadeOut();
					$("#signupForm").fadeIn();
					$("#signupFail").html(data);
					$("#signupFail").fadeIn();
					$('html,body').animate({
						scrollTop: $("#app").offset().top
					}, 'slow');
				}
            },
            error: function(data){
                alert("Contact Admin.");
            }
        });
    }));

});
    </script> 
</body>
</html>
