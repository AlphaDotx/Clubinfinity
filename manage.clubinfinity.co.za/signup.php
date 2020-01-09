<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Sign Up</title>
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
<?php if(isset($_GET['code'])){ 
    echo $msg = "<div class='alert alert-danger'>
				<strong>Oops!</strong>  your one time code is incorrect or expired. please try again!
			  </div>";
   } 
?>
                        <p class="text-xs-center">SIGNUP TO GET INSTANT ACCESS</p>
                        <form id="signup-form" action="signing.php" method="POST" novalidate="">
                           
                            <div class="form-group"> <label for="firstname">Name</label>
                                <div class="row">

                                    <div class="col-sm-6"> <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required=""> </div>
                                    <div class="col-sm-6"> <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required=""> </div>
                                </div>
                            </div>
                            
                            <!--div class="form-group"> <label for="email">Email</label> <input type="email" class="form-control underlined" name="email" id="email" placeholder="Enter email address" required=""> </div-->
                           
                            <div class="form-group"> <label for="email">Contact No.</label> <input type="text" class="form-control underlined" name="contact" id="email" placeholder="Enter your contact number" required=""> </div>
                           
                            <div class="form-group"> <label for="password">Password</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required=""> </div>
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Re-type password" required=""> </div>
                                </div>
                            </div> 
                            <div class="form-group"> <label for="email">Refferal No.</label> <input type="text" class="form-control underlined" name="refferal" id="email" value="<?php echo @$_GET['refferal']; ?>" placeholder="Enter refferal number"> </div>
                                  
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Sign Up</button> </div>
                            <div class="form-group">
                                <p class="text-muted text-xs-center">Already have an account? <a href="index.php">Login!</a></p>
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