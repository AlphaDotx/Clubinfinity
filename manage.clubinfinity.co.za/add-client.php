<?php
session_start();
require_once 'class.user.php';
require_once 'config.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$contact = $row['Contact'];





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
    
    
    
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE Contact=:email_id");
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
		if($user_home->register($uname,$name,$contact,$email,$upass,$code,$bank,$account_no,$account_type,$branch,$branch_code)){
			$id = $user_home->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
		 $msg = "<div class='alert alert-success'>
			<strong>Congradulations!</strong> ".$uname." ".$name.", you're successfully registered as a member.
			  		</div>"; 
		}
		else
		{
		$msg = "<div class='alert alert-danger'>
				<strong>Oooops!</strong>  The email you are trying to sign up with is already used!
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
        <title> Administrator Panel - Accounts </title>
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
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
                      <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <sup>
<?php 
$id=$_SESSION['userSession'];
$sql = ("SELECT COUNT(*) FROM tbl_pending WHERE userID='$id'");
$rs = mysql_query($sql);
$result = mysql_fetch_array($rs);
$notification = $result[0];
?>            
    			      <span class="counter"><?php echo $notification ?></span>
    			    </sup> </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                       
 <?php 
$flag=0;
$id=$_SESSION['userSession'];
$pending="SELECT * FROM tbl_pending WHERE userID='$id'";
$pendingresult=mysql_query($pending); 
 while ($pendingrow = mysql_fetch_array($pendingresult)) {
?>                                 
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('http://simpleicon.com/wp-content/uploads/user-3.svg')"></div>
                                                </div>
                                                <div class="body-col">
                                               <p><?php echo $pendingrow['username']; ?></b> allocated to pay you</p>
												<p><span>R<?php echo $pendingrow['amount']; ?></span></p>
                                                 </div>
                                            </a>
                                        </li>
<?php
 }
?>    
                                       
                                        
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li> <a href="">
    			            View All
    			          </a> </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('http://simpleicon.com/wp-content/uploads/user-3.svg')"> </div> 
                                    <span class="name"> <?php echo $row['Name']; ?> </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="profile.php"> <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="accounts.php"> <i class="fa fa-gear icon"></i>Account Settings </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"> <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                           
                                         
                                      <img src="logo.png" style="width:45px; margin-top:-45px;"> </div>
                                 My <span style="color:#52BCD3;">Admin</span> </div>
                        </div>
                                   <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li class="active">
                                    <a href="add-client.php"> <i class="fa fa-plus-square"></i> Add Client  </a>
                                 </li>
                                <li>
                                    <a href=""> <i class="fa fa-th-large"></i> Manage Funds </a>
                                    
                                    <ul>
                                        <li> <a href="pending.php">
    								Pending Funds
    							</a> </li><li> <a href="investment.php">
    								Investments
    							</a> </li>
                                        <li> <a href="payments.php">
    								Due Payments
    							</a> </li>
                                    </ul>
                                    
                                </li>
                                <li>
                                    <a href="shout-out.php"> <i class="fa fa-envelope-o"></i> Shout-Out  </a>
                                 </li>
                                <li>
                                    <a href="transactions.php"> <i class="fa fa-bar-chart"></i> Transaction Records </a>
                                 </li>
                                <li>
                                    <a href="users.php"> <i class="fa fa-users"></i> Clients Records</a>
                                  </li>
                            </ul>
                        </nav>
                    </div>
                   
                </aside>
                
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
               
               
               <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content responsive-tables-page">
                    <div class="title-block">
                        <h1 class="title">
		New Member
	</h1><p class="title-description"> Registering new member on the system </p>
                    </div>
 <?php echo @$msg; ?>
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <section class="example">
                                            
<form action="" method="post" class="mt" role="form">
    
<div class="form-group has-success">
<label class="control-label" for="inputSuccess1">Username:</label> 
<input type="text" name="firstname" value="" class="form-control underlined" id="inputSuccess1"  required >
</div>

<div class="form-group has-success"> 
<label class="control-label" for="inputSuccess1">Full Names:</label> 
<input type="text" name="lastname" value="" class="form-control underlined" id="inputSuccess1"  required >
</div>

<div class="form-group has-success">
<label class="control-label" for="inputWarning1">Contact Number:</label> 
<input type="text" name="contact" value="" class="form-control underlined" id="inputWarning1"  required >
</div>
                                       
<div class="form-group has-success">
<label class="control-label" for="inputError1">Email Address:</label>
<input type="text" class="form-control underlined" name="email" value=""  id="inputError1" required>
</div> 
                                            
<div class="form-group has-success">
<label class="control-label" for="inputError1">Password:</label>
<input type="password" class="form-control underlined" name="password" value=""  id="inputError1" required>
</div>               
                          <div class="form-group has-success">
                            <label class="control-label" for="inputError1">Confirm Password:</label>
                                <input type="password" class="form-control underlined" name="confirm-pass" value=""  id="inputError1" required>
                        </div>
                                            
                                            
                                            
                                            
<br>
<h3>Banking Details</h3>
                                            
<div class="form-group"> <label class="control-label">Account Holder</label> <input type="text" name="bank" value="" class="form-control underlined" required> </div>
<div class="form-group"> <label class="control-label">Account Number</label> <input type="text" name="account_no" value="" class="form-control underlined" required> </div>
<div class="form-group"> <label class="control-label">Account Type</label>   <input type="text" name="account_type" value="" class="form-control underlined" required> </div>
                                            
           <!--div class="form-group"> <label for="remember">
            <input class="checkbox" id="remember" name="verify" value="verify" type="checkbox"> 
               <span><small>Would you like to confirm contact number?</small>  </span>
          </label></div-->       
                                            
                                     <a href="home.php" class="btn btn-secondary">Cancel</a>  
                                    <input type="submit" name="btn-signup" class="btn btn-primary" value="Register Client">
                                    </form>
                                          
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
               
              
                <footer class="footer">
                   <div class="footer-block author">
                        <ul>
                            <li> Copyright 2017. <a href="">All rights reserved</a></li></li>
                        </ul>
                    </div>
                </footer>
               
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