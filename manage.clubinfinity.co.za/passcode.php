<?php
session_start();
require_once 'class.user.php';
$user = new USER();

$passcode = $_SESSION['passcode'];

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}


if(isset($_POST['btn-submit']))
{

	if($passcode == $_POST['passcode'])
	{
		$id = $_POST['id'];
		$code = $_POST['code'];
		
         header("location: resetpassword.php?id=".$id."&code=".$code);
			}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Ohhh! Crab!</strong>  Code doesn't match
			    </div>";
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
                        <p class="text-xs-center">Confirm Reseting Code</p>
                        
    <div class='alert alert-warning'>
			Please enter the enter the reseting code sent to <b><?php echo $_GET['num']; ?></b>
		</div>
		
  <form action="" method="post" class="mt">
       <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
<div class="form-group"> <label for="username">Enter passcode</label> 
<input type="text" class="form-control underlined" name="passcode" id="username" placeholder="Enter code" required> </div>
<input type="hidden" class="user" placeholder="Enter code"  name="id" value="<?php echo $_GET['id']; ?>" required/>
<input type="hidden" class="user" placeholder="Enter code"  name="code" value="<?php echo $_GET['code']; ?>" required/>                         
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-submit">Confirm Code</button> </div>
                            <div class="form-group">
                                <p class="text-muted text-xs-center">Remember your details? <a href="index.php">Sign In!</a></p>
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