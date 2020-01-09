<?php
session_start();
require_once 'class.user.php';
//require_once 'config.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$admin_name = $row['userName']." ".$row['Name'];;
$contact = $row['Contact'];
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - My Down Liners </title>
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
                    <div class="header-block header-block-search hidden-sm-down">
                       
                        <form role="search" action="" method="POST">
                            <div class="input-container"> <i class="fa fa-search"></i> 
                                <input type="search" name='search' placeholder="Search" autocomplete="off">
                                <div class="underline"></div>
                            </div>
                        </form>
                        
                    </div>
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
                                     </div> <span style="color:#52BCD3;">MyAdmin</span> </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                   <li>
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <!-- <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
                                </a> </li> -->
                                <li> <a href="due-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
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
                                        <li> <a href="payments.php"><i class="fa fa-caret-right"></i> &nbsp;
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
                                <li class="active">
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
		Client Management
	</h1>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
 
<?php
if(isset($_GET['code'])){ 
         
if($_GET['code']==600){
 echo '<div class="alert alert-danger fade in">
         <strong>Success!</strong> The user record is suscessfully deleted from the system </a>.
      </div>';   
  }elseif($_GET['code']==700){
 echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> '.@$_GET["name"].'s investment is successfully placed</a>.
      </div>';
  }elseif($_GET['code']==701){
 echo '<div class="alert alert-warning fade in">
         <strong>Success!</strong> '.@$_GET["name"].' is successfully suspended from participating on the system. </a>.
      </div>';
  }elseif($_GET['code']==702){
 echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> '.@$_GET["name"].' is successfully activated/confirmed and will be given the ability to participate.. </a>.
      </div>';
  }elseif($_GET['code']==703){
 echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> '.@$_GET["name"].'`s account is Unblocked and access will be granted ability to participate on the system again </a>.
      </div>';
  }          
}
?>                                         
                                        
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>Firtname</th>
                                                            <th>Lastname</th>
                                                            <th>Contact No.</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php 

if(isset($_POST['search']) AND $_POST['search'] !== ''){
$search  = $_POST['search']; 
                               
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userName like '%$search%' || Name like '%$search%' || Contact like '%$search%' || keep like '%$search%'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
//$name = $row['userName'];
?>
                                    
 <tr>
      <td><?php echo $row['userName']; ?> <i class="fa fa-user"></i></td>
      <td><?php echo $row['Name']; ?></a></td>
      <td><?php echo $row['Contact']; ?></td>
    
<td>
<?php   

if($row['userStatus']=="N"){
  echo "<label class='label label-danger'>SUSPENDED</label>";  
}elseif($row['userStatus']=="O"){
 echo "<label class='label label-warning'>INACTIVE</label>";
}else{
 echo "<label class='label label-success'>ACTIVE</label>";
}
 
?>   
</td>
<td>
<?php
if($_SESSION['userSession'] == '25' OR $_SESSION['userSession'] == '26' OR $_SESSION['userSession'] == '3' OR $_SESSION['userSession'] == '4101' OR $_SESSION['userSession'] == '4102' ){
?>
<div class="btn-group">
<button class="btn btn-warning btn-sm">Action</button>
<button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle"><span class="caret"></span></button>
<ul class="dropdown-menu">
  
    
<li>
<?php
if($row['userStatus']=="O"){ 
?>   
<a href="block.php?block=<?php echo $row['userID']; ?>&status=u&name=<?php echo $row['userName']; ?>" onclick="return confirm('Are you sure you want to unblock this member to start accessing and participating on the system?')"> &nbsp;&nbsp;<i class="fa fa-check-circle-o" aria-hidden="true"></i> Activate</a>
<?php
}else if($row['userStatus']=="Y"){
?>  
<a href="block.php?block=<?php echo $row['userID']; ?>&status=b&name=<?php echo $row['userName']; ?>" onclick="return confirm('Are you sure you want to suspend this member from participating on the system?')">
     &nbsp;&nbsp; <i class="fa fa-ban" aria-hidden="true"></i> Suspend</a>
<?php
}elseif($row['userStatus']=="N"){
?>  

<a href="block.php?block=<?php echo $row['userID']; ?>&status=us&name=<?php echo $row['userName']; ?>" onclick="return confirm('Are you sure you want to suspend this member from participating on the system?')">
     &nbsp;&nbsp; <i class="fa fa-ban" aria-hidden="true"></i> Unsuspend</a>

<?php
}
?>     
</li>
<div class="dropdown-divider"></div>
    
    
    
<li><a href="add-investment.php?userid=<?php echo $row['userID']; ?>&name=<?php echo $row['userName']; ?>">
      &nbsp;&nbsp; <i class="fa fa-plus" aria-hidden="true"></i> Place Investment</a></li>
<div class="dropdown-divider"></div>
    
    
<li><a href="edit-user.php?userid=<?php echo $row['userID']; ?>">  &nbsp;&nbsp; <i class="fa fa-retweet" aria-hidden="true"></i> Update</a></li>
<div class="dropdown-divider"></div>
    
    
 <li><a href="delete-user.php?userid=<?php echo $row['userID']; ?>&admin=<?php echo $admin_name; ?>&name=<?php echo $row['userName']; ?>"  onclick="return confirm('Are you sure you want to DELETE this member? \n This will remove all the user records on the system! \n\n There is NO undo!!')">  &nbsp;&nbsp; <i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li> 

    
    
    </ul>
</div>


</td>
  </tr>
  <?php
  }
 }
}
?>  

                                                    </tbody>
                                                </table>
                                            </div>
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