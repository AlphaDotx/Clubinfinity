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
        <title> Administrator Panel - Password Reminder</title>
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
        	 <img src="logo.png" style="width:45px; margin-top:-45px;"> 
        </div>        <span style="color:#52BCD3;">MyAdmin</span>
      </h1> </header>
                    <div class="auth-content">
                        <p class="text-xs-center">PASSWORD REMINDER</p>
                        <p class="text-muted text-xs-center"><small>Enter your email address to recover your password.</small></p>
                        
<?php  
if(isset($_POST['email'])){ 
    
    $email = $_POST['email']; 
    $from = "info@Administrator Panel.org";
    $subject = "Password Reminder";
    
    $headers = "From: $from";
     
          
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
        
        $body = 'HI! '.$row['userName'].'/r/n';
        $body .= '/r/n';
        $body .= 'Here is your login details: /r/n';
        $body .= '/r/n';
        $body .= 'Note that login credentials are very sensetive! type them as they are!!';
        $body .= '/r/n';
        $body .= 'Email: '.$row['userEmail'].'/r/n';
        $body .= 'Password: '.$row['userPass'].'/r/n';
        $body .= '/r/n';
        $body .= 'Regards /r/n';
        $body .= 'Administrator Panel Team';
        
        mail($email, $subject, $body, $headers);
        
		echo "<div class='alert alert-success'>
				<strong>Success!</strong> Your login details have been sent to your email.
			  </div>
			  ";
	}else{
   echo "<div class='alert alert-danger'>
				<strong>Warning!</strong>  Email not found!
			  </div>
			  ";   
    }
}
?>                    
                        <form id="reset-form" action="" method="POST" novalidate="">
                            <div class="form-group"> <label for="email1">Email</label> <input type="email" class="form-control underlined" name="email" id="email1" placeholder="Your email address" required> </div>
                            <div class="form-group"> <button type="submit" name="btn-submit" class="btn btn-block btn-primary">Remind Me</button> </div>
                            <div class="form-group clearfix"> <a class="pull-left" href="index.php">return to Login</a> <a class="pull-right" href="signup.php">Sign Up!</a> </div>
                        </form>
                    </div>
                </div>
                <!--div class="text-xs-center">
                    <a href="index.html" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
                </div-->
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