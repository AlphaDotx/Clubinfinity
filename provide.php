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
  <title>Providing help - Cub Infinity</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Providing Help</a>
        
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
          
<?php

if(isset($_POST['update'])){

  if($user_home -> updatePH($_POST['price'],$_POST['trace'])){

    echo '<div class="alert alert-success" role="alert">
        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-inner--text"><strong>Success!</strong> This is a notification that you have successfully changed your PH amount.</span>
    </div>';

  }



}


 if($user_home -> Check_tempPH($_SESSION['userSession']) == 0){

//-----------------check if there's any pending PH-----------------//
 if($user_home -> CheckPH($_SESSION['userSession']) == 0){
 ?>
<div class="card">
    <div class="card-body">
      <h3 class="card-title">Provide Help</h3>


      <form role="form" action="make-order.php" method="POST">
                            
      <!--<div>-->
      <!--                      <label>-->
      <!--                   <input class="radio" type="radio" name="amount" value="200" checked=checked>-->
      <!--                   <span>R200</span>-->
      <!--               </label>-->
      <!--                     </div>-->
                                
                           <!-- <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="400">
                         <span>R400</span>
                     </label>
                           </div> -->
                                

                            <div> 
                            <label>
                         <input class="radio" name="amount" type="radio" value="500">
                         <span>R500</span>
                     </label>
                           </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="1000">
                         <span>R1 000</span>
                     </label>
                           </div>
                               
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="1500">
                         <span>R1 500</span>
                     </label>
 </div>    
                         
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="2000">
                         <span>R2 000</span>
                     </label>
                           </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="2500">
                         <span>R2 500</span>
                     </label>
 </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="3000">
                         <span>R3 000</span>
                     </label>
                           </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="3500">
                         <span>R3 500</span>
                     </label>
 </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="4000">
                         <span>R4 000</span>
                     </label>
                           </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="4500">
                         <span>R4 500</span>
                     </label>
 </div>
                           
                           <div>
                            <label>
                         <input class="radio" type="radio" name="amount" value="5000">
                         <span>R5 000</span>
                     </label>
                           </div>
                                
                 <br>
                           
                           <button type="submit" id="submit" class="btn btn-primary-outline btn-lg btn-block">Provide Help</button>
                               
                               </div>
                          
                       </div>
                  
                    
                    </form>


    </div>
    <?php
 }else{    
   
  
$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
  $traceid = $row['traceid'];

?>



<div style="width: 18rem;">
    
<div class="card card-stats mb-4 mb-lg-0" data-toggle="modal" data-target="#modal-form">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Help pending</h5>
                <span class="h2 font-weight-bold mb-0">R<?php echo $row['price']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                  <i class="fas fa-sync"></i>
              </div>
            </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> +100%</span>
            <span class="text-nowrap">In 4 days of payment</span>
        </p>
    </div>
</div>


</div>


<?php
    }
 }
}else{
   ?> 
<div class="card">
    <div class="card-body">
      <h1 class="card-title">Upliner Banking Information</h1>
      <div class="alert alert-info" role="alert">
        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
        <span class="alert-inner--text"><strong>Info!</strong> This is a notice to make a payment of <b>R200</b> to your recruiter using the following details.</span>
    </div>
      <?php

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userName=:ud");
$stmt->execute(array(":ud"=>$row['refferal']));
$urow = $stmt->fetch(PDO::FETCH_ASSOC);

$uname = $urow['userName'];
$name = $urow['Name'];
$ucontact = $urow['Contact'];
$ubank = $urow['bank'];
$uaccount_no = $urow['account_no'];

echo '<p>
<span style="font-weight:600; font-size:15px;">Account Holder:</span> '.$name.'<br>
<span style="font-weight:600; font-size:15px;">Contact Number:</span> '.$ucontact.'<br>
<span style="font-weight:600; font-size:15px;">Bank Name:</span> '.$ubank.'<br>
<span style="font-weight:600; font-size:15px;">Account Number:</span> '.$uaccount_no.'<br>
<span style="font-weight:600; font-size:15px;">Reference: </span> '. $uname.'</br>
</ul></p>';

?>   
    </div>
  </div>    
  <?php  
}
 ?>
  </div>
  

  <div class="col-md-4">
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        	
            <div class="modal-body p-0">
            	
                	
<div class="card bg-secondary shadow border-0">
  
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
            <small>Updating Pending Help information</small>
        </div>
        <form role="form" action="#" method="post">
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                    </div>
<input type="hidden" name="trace" value="<?php echo $traceid; ?>">

                    <select class="form-control" name="price">
                      <option disabled=disabled>---------select new amount-------</option>
                      <option value="200"> R200</option>
                      <option value="400"> R400</option>
                      <option value="500"> R500</option>
                      <option value="1000"> R1 000</option>
                      <option value="2000"> R2 000</option>
                      <option value="3000"> R3 000</option>
                      <option value="4000"> R4 000</option>
                      <option value="5000"> R5 000</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="update" class="btn btn-primary my-4">Update</button>
            </div>
        </form>
    </div>
</div>
  
        </div>
      </div>
     
      <!-- Footer -->
     
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