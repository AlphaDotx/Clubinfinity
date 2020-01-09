<?php
session_start();
require_once 'class.user.php';
require_once 'smss.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$contact = $row['Contact'];
?>
<?php
if(isset($_POST['radios']) AND isset($_POST['btn-send'])){
    
if($_POST['radios'] == "one"){
    
if($_POST['number'] !== ''){    
$numbers = '"'.$_POST['number'].'"';
$message = '"'.$_POST['message'].'"';
$test = new MyMobileAPI();
$test->sendSms($numbers,$message);
    
    $msg = '<div class="alert alert-success fade in">
         <strong>Success!</strong> Your message is successfully sent to '.$_POST['number'].' </a>.
      </div>';
    
}else{
    
  $msg = '<div class="alert alert-danger fade in">
         <strong>Error!</strong> Please enter the contact number you wish to contact </a>.
      </div>';
    
}
    
}else{
    
header('location: sms.php');
    
}
    
}

?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Provide Help </title>
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
        <script type="text/javascript">
function showhidediv( rad )
    {
        var rads = document.getElementsByName( rad.name );
        document.getElementById( 'one' ).style.display = ( rads[0].checked ) ? 'block' : 'none';
        document.getElementById( 'two' ).style.display = ( rads[1].checked ) ? 'block' : 'none';
        
}

function isNumberKey(evt){ // Numbers only
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
	
        return false;

    return true;
	
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
                                     <img src="logo.png" style="width:45px; margin-top:-45px;"> 
                                    </div> My <span style="color:#52BCD3;">Admin</span> </div>
                        </div>
                         <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                     <li>
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
    							</a> </li><li> <a href="payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								Withdrawn Funds
    							</a> </li>
                                    </ul>
                                    
                                 </li>
                                <li>
                                    <a href=""> <i class="fa fa-th-large"></i> Manage Funds &nbsp; <i class="fa fa-caret-down"></i></a>
                                    
                                    <ul>
                                        <li> <a href="pending.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Pending Funds
    							</a> </li><li> <a href="investment.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Investments
    							</a> </li>
                                        <li> <a href="due-payments.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Due Payments
    							</a> </li>
                                    </ul>
                                    
                                </li>
                                <li class="active">
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
		Message Service
	</h1>
      <p class="title-description"> This panel is used to contact clients through smss. </p>
                    </div>
<?php echo @$msg; ?>
<?php 
if(isset($_GET['code'])){
  if($_GET['code']=="600"){
  echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> Your message is successfully sent to all your clients</a>.
      </div>';  
  }  
}
?>
    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-12">
                                <div class="card card-block sameheight-item">
                                    <form role="form" action="" method="post">
                            <div><label>
			                 <input class="radio" name="radios" value="one" onclick="showhidediv(this);" type="radio">
			                 <span>Send to Individual</span> 
                            
			                </label></div>
                                        
                             <div id="one" class="CF" style="display:none;"  >
                             <div class="form-group"> <label class="control-label">Enter contact number</label> 
    <input type="text" name="number" class="form-control underlined" min="10" maxlength=10 OnKeypress="javascript:return isNumberKey(event);" autocomplete="off"></div>
                              </div>            
                                        
                            <div> <label>
			                 <input class="radio" type="radio" value="all"  onclick="showhidediv(this);" name="radios">
			                 <span>Send to all clients</span>
			                </label> </div>
                                        
                                        <div class="form-group"> <label class="control-label">Message</label> <textarea rows="3" name="message" class="form-control underlined"></textarea> </div>
                                   
<input type="submit" name="btn-send" class="btn btn-primary btn-lg btn-block" value="Send">
                                </form> </div>
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