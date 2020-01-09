<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}





if(isset($_POST['btn-signup']))
{
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
    
    
    
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE Contact=:email_id");
	$stmt->execute(array(":email_id"=>$contact));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "<div class='alert alert-danger'>
				<strong>Warning!</strong>  Your information already exist in the system, Please Try signing In
			  </div>
              
              <a href='index.php' class='btn btn-block btn-primary'>Sign In here</a>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$name,$contact,$email,$upass,$code,$bank,$account_no,$account_type,$branch,$branch_code)){
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
		 $msg = "<div class='alert alert-success'>
			<strong>Congradulations!</strong> ".$uname." ".$name.", you're successfully registered as a member.
			  		</div>
                      
            <a href='index.php' class='btn btn-block btn-primary'>Sign In here</a>
					"; 
		}
		else
		{
		$msg = "<div class='alert alert-danger'>
				<strong>Oooops!</strong>  The email you are trying to sign up with is already used!
			  </div>

              <a href='index.php' class='btn btn-block btn-primary'>Sign In here</a>
			  ";	
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
                        <p class="text-xs-center"><h3>Banking Details</h3></p>
                        <form id="signup-form" action="signing-verify.php" method="POST" novalidate="">
                         
                         <input type="hidden" name="firstname" value="<?php echo $_POST['firstname']; ?>">
                         <input type="hidden" name="lastname" value="<?php echo $_POST['lastname']; ?>">
                         <input type="hidden" name="email" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                         <input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">
                         <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
                         <input type="hidden" name="refferal" value="<?php echo $_POST['refferal']; ?>">
                          
                         
                            <div class="form-group"> <label for="text">Bank Name:</label> <input type="text" class="form-control underlined" name="bank" placeholder="Enter bank name" required=""> </div>
                           
                            <div class="form-group"> <label for="text">Account No:</label> <input type="text" class="form-control underlined" name="account_no" placeholder="Enter account number" required=""> </div>
                           
                            <div class="form-group"> <label for="text">Account Type:</label> <input type="text" class="form-control underlined" name="account_type" placeholder="Enter account typer" required=""> </div>
                           
            <div class="form-group"> <label for="remember">
            <input class="checkbox" id="remember" type="checkbox" required=""> 
            <span>Agree to <a href="tc.php" class="forgot-btn pull-right">Terms & Conditions</a>  </span>
          </label></div>
                           
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary" name="btn-send">Proceed</button> </div>
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