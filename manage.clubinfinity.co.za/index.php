<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$contact = trim($_POST['contact']);
	$upass = trim($_POST['txtupass']);

	if($user_login->login($contact,$upass))
	{
		$user_login->redirect('home.php');
	}
}
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Sign In</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-green.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-green.css">');
            }
        </script>
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
        <div class="logo">
        	 <img src="logo.png" style="width:45px; margin-top:-10px;"> 
        </div>        My <span style="color:#52BCD3;">Admin</span>
      </h1> </header>
                    <div class="auth-content">
                        <p class="text-xs-center">LOGIN TO CONTINUE</p>
<?php 
if(isset($_GET['inactive']))
{
?>
<div class="alert alert-dismissible alert-info" role="alert">
<strong>Sorry!</strong> Your account is not activated. Please pay your <strong>R100</strong> joining fee to start participating.
</div>
<?php
}
?>
<?php 
if(isset($_GET['blocked']))
{
?>
<div class="alert alert-dismissible alert-info" role="alert">
<strong>Warning!</strong> Your account has been suspended. Please contact administrator 
</div>
<?php
}
?>
<?php 
if(isset($_GET['pending']))
{
?>
<div class="alert alert-dismissible alert-info" role="alert">
<strong>CAUTION!</strong> Your account is not activated yet. Please pay your <strong>R100</strong> administrator fee to start participating.
</div>
<?php
}
?>

                        <form id="login-form" action="" method="POST" novalidate="">
<?php
        if(isset($_GET['error']))
		{
			?>
            <div class="alert alert-dismissible alert-danger">
			
			<strong>Oops!</strong> You have entered incorrect details!!.
			</div>
            <?php
		}
?>
                            <div class="form-group"> <label for="username">Contact Number</label> <input type="text" class="form-control underlined" name="contact" id="username" placeholder="Your contact number" required onkeyup="this.value=this.value.replace(/[^\d]/,'')"> </div>
                            <div class="form-group"> <label for="password">Password</label> <input type="password" class="form-control underlined" name="txtupass" id="password" placeholder="Your password" required> </div>
                            <div class="form-group"> <label for="remember">
            <input class="checkbox" id="remember" type="checkbox"> 
            <span>Remember me</span>
          </label> <a href="forgotpassword.php" class="forgot-btn pull-right">Forgot password?</a> </div>
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-login">Login</button> </div>
                            <div class="form-group">
                                <p class="text-muted text-xs-center">Do not have an account? <a href="signup.php">Sign Up!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>