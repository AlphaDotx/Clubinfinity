<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Your Password is successfully Changed.
						</div>";
				header("refresh:2;index.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
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
                        <p class="text-xs-center">Reseting Your password</p>
    <div class='alert alert-warning'>
			<strong>Hi!  <?php echo $rows['userName'] ?></strong> you are here to reset your forgetton password.
		</div>
  <form action="" method="post" class="mt">
       <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
                            <div class="form-group"> <label for="username">New Password</label> <input type="text" class="form-control underlined" name="pass" id="username" placeholder="Enter New Password" required> </div>
                            <div class="form-group"> <label for="password">Confirm Password</label> <input type="password" class="form-control underlined" name="confirm-pass" id="password" placeholder="Confirm Password" required> </div>
                           
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-reset-pass">Reset Password</button> </div>
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