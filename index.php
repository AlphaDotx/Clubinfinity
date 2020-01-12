<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{
	$contact = trim($_POST['contact']);
	$upass = trim($_POST['txtupass']);

	if($user_login->login($contact,$upass))
	{
		$user_login->redirect('dashboard.php');
	}
}
?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Sir Williams">
  <title>Sign in - club infinity</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e16c30c7e39ea1242a3bdb2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="">
          <img src="assets/img/brand/white.png" />
        </a>
        
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-banner py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light">Use the form to sign in or opt to sign up if you have'nt signed up yet.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in</small></div>
           
            </div>
            <div class="card-body px-lg-5 py-lg-5">
             
              <?php 
if(isset($_GET['inactive']))
{
?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fas fa-info-circle fa-lg"></i></span>
    <span class="alert-inner--text"><strong>Info!</strong> Your account is not yet activated pending R120 registration fee.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
}
?>
<?php 
if(isset($_GET['blocked']))
{
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fas fa-exclamation-circle fa-lg"></i></span>
    <span class="alert-inner--text"><strong>Warning!</strong> Your account has been blocked, please contact administrator for further assistance.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
}
?>


                        <form role="form" method="POST" action="">
<?php
        if(isset($_GET['error']))
		{
			?>
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fas fa-exclamation-triangle fa-lg"></i></span>
    <span class="alert-inner--text"><strong>Error!</strong> Your credentials are incorrect.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
            <?php
		}
?>
<?php 
if(isset($_GET['response']) && !empty($_GET['response'])){

$stmt = $user_login->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>base64_decode($_GET['response'])));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
    <div class="alert alert-dismissible alert-info" role="alert">
Please make a payment to your recruiter to the details below.
    </div>
    <div class="alert alert-dismissible alert-warning" role="alert">
            <h4>RECRUITMENT FEE</h4>
       
            <strong>Recruiter:</strong> <?php echo $row['Name']; ?><br>
            <strong>Contact No.:</strong> <?php echo $row['Contact']; ?><br>
            <strong>Bank Name:</strong> <?php echo $row['bank']; ?><br>
            <strong>Account No.:</strong> <?php echo $row['account_no']; ?><br>
            <strong>Amount:</strong> R100<br>

        </div>
<?php

}
?>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input class="form-control" name="contact" placeholder="Your number" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="txtupass" placeholder="Password" type="password">
                  </div>
                </div>
                <!-- <div class="col-12">
              <a href="register.php?code=MQ==" class="text-light"><small>Create new account</small></a>
            </div> -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" name="btn-login">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="forgotpassword.php" class="text-light"><small>Forgot password?</small></a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 All rights reserved.<a href="" class="font-weight-bold ml-1"> Club Infinity </a>
          </div>
        </div>
   
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
</body>

</html>