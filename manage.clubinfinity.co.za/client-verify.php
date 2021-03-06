<?php
session_start();
//require_once 'sms.php';
require_once 'class.user.php';

$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
//sending registration code
if(isset($_POST['btn-signup'])){
$_SESSION['otc'] = rand(9999, 99999);

echo $_SESSION['otc'];

//Execute script
//$numbers = '"'.$_POST['contact'].'"';
//$test = new MyMobileAPI();
//$test->sendSms($numbers,'Dear Administrator Panel Applicant, Here is your verification code: '.$_SESSION['otc']); //Send SMS
//$test->checkcredits(); //Check your credit balance

}


if(isset($_POST['btn-verify']))
{
    
if($_SESSION['otc'] != $_POST['otc']){
header("location: signup.php?code=600");
exit();
} 
  
	$uname = trim($_POST['firstname']);
	$name = trim($_POST['lastname']);
	$contact = trim($_POST['contact']);
	$email = trim($_POST['email']);
	$upass = trim($_POST['password']);
	$code = md5(uniqid(rand()));
	
    $bank = trim($_POST['bank']);
    $account_no = trim($_POST['account_no']);
    $account_type = trim($_POST['account_type']);
    
    $branch = 0;//trim($_POST['branch_code']);
    
$inviteid = @trim($_POST['refferal']);

 if($inviteid== ""){
    $branch_code = 00000; //trim($_POST['branch']);
 }else{
    $branch_code = trim($inviteid);   
}
    
    
    
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE Contact=:email_id");
	$stmt->execute(array(":email_id"=>$contact));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
	$msg = "<div class='alert alert-warning'>
				<strong>Warning!</strong>  Your information already exist in the system, Please Try signing In
			  </div>";
	}
	else
	{
		if($user_home->register($uname,$name,$contact,$email,$upass,$code,$bank,$account_no,$account_type,$branch,$branch_code)){
			$id = $user_home->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
  $msg = "<div class='alert alert-success'>
			<strong>Congradulations!</strong> ".$uname." ".$name.", you're successfully registered on Administrator Panel.<br/>
                    </div>"; 
		}
		else
		{
		$msg = "<div class='alert alert-danger'>
				<strong>Error!</strong>  Registration failed! please review your information and try again or contact admin for further assistance
			  </div>";	
		}		
	}
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
                        <?php if(isset($msg)){ echo $msg; }else{?>
                        
                        <p class="text-xs-center"><h3>Contact No. Verification</h3></p>
                        <form id="signup-form" action="" method="POST" novalidate="">
                         
                         
                         <input type="hidden" name="firstname" value="<?php echo $_POST['firstname']; ?>">
                         <input type="hidden" name="lastname" value="<?php echo $_POST['lastname']; ?>">
                         <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                         <input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">
                         <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
                         <input type="hidden" name="refferal" value="<?php echo $_POST['refferal']; ?>">
                         
                         <input type="hidden" name="bank" value="<?php echo $_POST['bank']; ?>">
                         <input type="hidden" name="account_no" value="<?php echo $_POST['account_no']; ?>">
                         <input type="hidden" name="account_type" value="<?php echo $_POST['account_type']; ?>">
                         
                         
                            <div class="form-group"> <label for="text">One Time Code:</label> <input type="text" class="form-control underlined" name="otc" placeholder="Enter one time code" required=""> </div>
                           
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-verify">Register</button> </div>
                           <?php } ?>
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