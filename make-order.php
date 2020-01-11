<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Sir Williams">
  <title>Help Confirmation - Cub Infinity</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">

</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="">
        <img src="assets/img/brand/white.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
      
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <i class="fas fa-user-circle fa-3x"></i>
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span><b>Username: </b></span> <?php echo $row['userName']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span><b>Contact:</b></span> <?php echo $row['Contact']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span><b>Bank:</b></span> <?php echo $row['bank']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span><b>Account no.: </b></span><?php echo $row['account_no']; ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="">
                <img src="./assets/img/brand/white.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
     
              <!-- Navigation -->
              <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="ni ni-tv-2 text-info"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="provide.php">
              <i class="fas fa-hands-helping fa-lg text-green"></i> Provide Help
            </a>
          </li>
                    <li class="nav-item">
            <a class="nav-link" href="followers.php">
             <i class="fas fa-user-plus text-black"></i> Downliners
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fas fa-lock text-orange"></i> Log Out
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Providing Help</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <i class="fas fa-user-circle fa-3x"></i>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $row['Name']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span><b>Username: </b></span> <?php echo $row['userName']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span><b>Contact:</b></span> <?php echo $row['Contact']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span><b>Bank:</b></span> <?php echo $row['bank']; ?>
            </a>
            <a href="" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span><b>Account no.: </b></span><?php echo $row['account_no']; ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
              </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-banner pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          
        <div class="row">


                   
<?php
if(empty($_POST['amount'])){
echo "<div class='alert alert-danger' role='alert'>
	<strong>ERROR!</strong>  Please select the amount that you would like to assist with.
</div> ";
exit();
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_temp_helpers WHERE userID=:my_id");
$stmt->execute(array(":my_id"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0){
echo "<div class='alert alert-danger' role='alert'>
	<strong>WARNING!</strong>  You are only allowed to provide help once at a time! Please settle the first one before you make another one.
</div> ";
exit();
}

if(isset($_POST['provide'])){
$date = @date("Y-m-d | H:m:s");
$amount = @trim($_POST['amount']);
$id = $_SESSION['userSession'];

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid LIMIT 1");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userName = $row['userName'];
$bank = $row['bank'];


if($user_home->Addhelpers($_SESSION['userSession'],0,$userName,$amount,$bank,$date)){
	 
echo "<div class='alert alert-info' role='alert'>
	<strong> Well done </strong> You are about to place an order to provude help, Please note that allocations will take place within 24hours. <br>";
	
}else{
  echo "Something terrible happened..........";
}   
}else{

?>                        
 <div class="col-xl-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <div class="header-block">
                                            <p class="title"> Help Proving Confirmation </p>
                                        </div>
                                    </div>
                               
<div class="card-body">
<p> <small>Please make sure you have selected the correct amount before you proceed!</small>.</p>
<h1> You have opted to assist with <strong>R<?php echo @$_POST['amount']; ?></strong></h1>

                                    
                                    
<form action="" method="post">
<input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
<a href="provide.php" class="btn btn-danger">Back</a>
<button type="submit" name="provide" class="btn btn-success">Proceed</button>
</form>

<div class="card-footer"><b>NOTE</b>: <small>Please note that any cancellation will result in a penalty of susspension of your account.</small></div>
</div>
</div>                 
 </div>
</div>
<?php                                    
}       
 ?> 
                        </div>
                   


    </div>

  
  
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2020  All rights reserved.<a href="" class="font-weight-bold ml-1"> Club Infinity</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
</body>

</html>