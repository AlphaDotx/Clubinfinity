<?php
session_start();
require_once 'class.user.php';
require_once 'smss.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}


if(isset($_POST['btn-submit']))
{
 $email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE Contact=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE Contact=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));

$range = rand(499, 5999);
$_SESSION['passcode'] = $range;

$numbers = '"'.$email.'"';
$test = new MyMobileAPI();
$test->sendSms($numbers,'HI! here is your password reset code '.$_SESSION['passcode']); //Send SMS


header("location: passcode.php?id=".$id."&code=".$code."&num=".$email);
			
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  this contact number is not found. 
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
                        <p class="text-xs-center">Reseting Your Password</p>
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Please enter your contact no. You will receive a link to create a new password via sms.!
				</div>  
                <?php
			}
			?>
            <form action="" method="post" class="mt">
                            <div class="form-group"> <label for="username">Contact Number</label> <input type="text" class="form-control underlined" name="txtemail" id="username" placeholder="Your contact number" required=""> </div>
                           
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-submit">Resent Password</button> </div>
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