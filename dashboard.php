<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}


date_default_timezone_set('Africa/Johannesburg');
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
  <title>Dashboard - Cub Infinity</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <script type="text/javascript">

function CountUp(initDate,id){
    this.beginDate = new Date(initDate);
    this.numOfDays = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
    var currYear = (new Date()).getFullYear();
    if ( (currYear % 4 == 0 && currYear % 100 != 0 ) || currYear % 400 == 0 ) {
        this.numOfDays[1] = 29;
    }
    this.borrowed = 0, this.years = 0, this.months = 0, this.days = 0;
    this.hours = 0, this.minutes = 0, this.seconds = 0; 
    this.calculate();
    this.update(id);
}
 
CountUp.prototype.datePartDiff=function(then, now, MAX){
    var temp = this.borrowed;   
    this.borrowed = 0;
    var diff = now - then - temp;
    if ( diff > -1 ) return diff;
    this.borrowed = 1;
    return (MAX + diff);    
}
 
CountUp.prototype.formatTime=function(){
    this.seconds = this.addLeadingZero(this.seconds);
    this.minutes = this.addLeadingZero(this.minutes);
    this.hours = this.addLeadingZero(this.hours);
}
 
CountUp.prototype.addLeadingZero=function(value){
    return (value + "").length < 2 ? ("0" + value) : value;
}
 
CountUp.prototype.calculate=function(){
    var currDate = new Date();
    var prevDate = this.beginDate;
    this.seconds = this.datePartDiff(prevDate.getSeconds(), currDate.getSeconds(), 60);
    this.minutes = this.datePartDiff(prevDate.getMinutes(), currDate.getMinutes(), 60);
    this.hours = this.datePartDiff(prevDate.getHours(), currDate.getHours(), 24);
    this.days = this.datePartDiff(prevDate.getDate(), currDate.getDate(), this.numOfDays[currDate.getMonth()-1]);
    this.months = this.datePartDiff(prevDate.getMonth(), currDate.getMonth(), 12);
    this.years = this.datePartDiff(prevDate.getFullYear(), currDate.getFullYear(),0);   
}
 
CountUp.prototype.update=function(id){
    if ( ++this.seconds == 60 ) {
        this.seconds = 0;
        if ( ++this.minutes == 60 ) {
            this.minutes = 0;
            if ( ++this.hours == 24 ) {
                this.hours = 0;
                if ( ++this.days == this.numOfDays[(new Date()).getMonth()-1]){
                    this.days = 0;
                    if ( ++this.months == 12 ) {
                        this.months = 0;
                        this.years++;
                    }
                }
            }
        }
    }
    this.formatTime();  
    var countainer = document.getElementById(id);
    countainer.innerHTML ="<strong> " + this.days + "</strong> <small>days</small> <strong>" + this.hours + "</strong> <small>hours</small> <strong>" + 
        this.minutes + "</strong> <small>minutes</small> <strong>" + this.seconds +
        "</strong> <small>seconds</small>.";
    var self=this;
    setTimeout(function(){self.update(id);}, 1000);
}
</script>
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
              <a href="./index.html">
                <img src="./assets/img/brand/blue.png">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Dashboard</a>
     
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <i class="fas fa-user-circle fa-3x"></i>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $row['Name'].' '.$row['userName']; ?></span>
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
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Help Provided</h5>
                      <span class="h2 font-weight-bold mb-0">

                        R<?php echo $mm = $user_home -> provide_stats($_SESSION['userSession']); ?>

                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> </span>
                    <span class="text-nowrap">Help you provided</span>
                  </p>
                </div>
              </div>
            </div>

    

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Help Requested</h5>
                      <span class="h2 font-weight-bold mb-0">

R<?php echo $mm = $user_home -> request_stats($_SESSION['userSession']); ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                    <span class="text-nowrap">Help you reguested</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 "  
            <?php   $funds = $user_home -> GrowingFunds($_SESSION['userSession']); 
            if(!empty($funds)){
              ?>
            data-toggle="modal" data-target="#modal-default"
            <?php
            }
            ?>
            >
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Growing Funds</h5>
                      <span class="h2 font-weight-bold mb-0">
                      R<?php
                    
                      if(empty($funds)){
                        echo 0;
                      }else{
                        echo $funds;
                      }
                      ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-chart-line"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-info mr-2"><i class="fas fa-chart-line"></i> </span>
                    <span class="text-nowrap">Your money on the system</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
<?php
if(isset($_GET['code'])){
  if($_GET['code']==700){
?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                   <span class="alert-inner--text"><strong>Success!</strong> Your payment confirmation was successful.</span>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                  </button>
            </div>
<?php
  }elseif($_GET['code']==701){

?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                   <span class="alert-inner--text"><strong>Success!</strong> Your investment is successfully withdrawn.</span>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                  </button>
            </div>

<?php
  }
}

 if($user_home -> Check_tempPH($_SESSION['userSession']) > 0 || $row['userStatus'] == "O"){
     ?>
 <div class="alert alert-info" role="alert">
        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
        <span class="alert-inner--text"><strong>Info!</strong> This is a notice to make a payment of <b>R200</b> to your recruiter, please click <b>Provide Help</b> for more details.</span>
    </div>
<?php
}
?>

            <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Transaction History</h3>
                </div>
                
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Sender</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Amount</th>
                    <th scope="col">date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
<?php                                
$stmt = $user_home->runQuery("SELECT * FROM tbl_history WHERE myid=:uid OR userid=:userid  ORDER BY `tbl_history`.`date` DESC");
$stmt->execute(array(":uid"=>$_SESSION['userSession'],":userid"=>$_SESSION['userSession']));
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
?>
                  <tr>
                    
      <td><?php echo $row['hfrom']; ?></a></td>
      <td><?php echo $row['hto']; ?></td>
      
      <td>
      <?php 
      if($row['status']==0){
         echo '<i class="fas fa-sync text-warning mr-3"></i>';
      }elseif($row['status']==1){
         echo '<i class="fas fa-check-circle text-success mr-3"></i>';
      }else{
       echo '<i class="fas fa-times text-danger mr-3"></i>';
      }
       ?>
       R<?php echo $row['amount']; ?>
      
      
      </td>
                                                
       <td><?php echo $row['date']; ?></td>
                    
                    <td>
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

    <?php
      if($row['userid'] == $_SESSION['userSession']){
      ?>
       <a href="details.php?userid=<?php echo $row['myid']; ?>"  class="dropdown-item"> View info. </a>
       <?php
       
      }else{
      ?>
       <a href="details.php?userid=<?php echo $row['userid']; ?>"  class="dropdown-item"> View info. </a>
        <?php
      }
      if($row['userid']==$_SESSION['userSession'] && $row['status'] == 0){
      ?>
        
                            <a class="dropdown-item" href="confirm.php?traceid=<?php echo $row["traceid"] ?>" onclick="return confirm('Are you sure you want to confirm this payment? \n This will not be undone!')">confirm Payment</a>
    <?php
      }
    ?>
    
    
                          </div>
                        </div>
                      </td>
                  </tr>

<?php
}
?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
 

<!--investment modal-->
        <div class="col-md-4">
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
              <div class="modal-content">
                
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-default">Investment Information</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <?php                 
$stmt = $user_home->runQuery("SELECT * FROM tbl_waitinglist WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>                
                  <div class="modal-body">
                    

                  <div class="py-3 text-center">
                  <i class="far fa-clock fa-8x"></i>

                      <p><div id="counter" ></div>.</p>
                      <p>You have privided the help of <b>R<?php echo $row['price']; ?></b> on this date <b><?php echo $date = $row['date']; ?></b>, which will mature on <b><?php echo $mdate = $row['mdate']; ?></b> with a balance of <b>R<?php echo $row['price']*2; ?></b>.</p>
                      
                  </div>
</div>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fas fa-info fa-lg"></i></span>
    <span class="alert-inner--text"> &nbsp; Auto re-allocations will take place in 24 hours.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

                  <div class="modal-footer">

<?php
if(@date("Y-m-d H:i:s") >= $mdate ){
?>
                      <form action="withdraw.php" method="post">
                        <input type="hidden" name="traceid" value="<?php echo $row['traceid']; ?>" ?>
                      <button type="submit" class="btn btn-primary">Withdraw Funds</button>
</form>
<?php
}
?>

                      <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
                  </div>
                  
              </div>
          </div>
      </div>
        </div>

<!--Kept funds modal-->
        <div class="col-md-4">
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
              <div class="modal-content bg-gradient-danger">
                
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Kept Money</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
<?php                 
$stmt = $user_home->runQuery("SELECT * FROM tbl_kept WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>                
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                      <i class="far fa-clock fa-8x"></i>
                          <h4 class="heading mt-4">You should read this!</h4>

                          <p>You have kept <strong>R<?php echo $row['price']; ?></strong> for the system which should be allocated before <strong><?php echo $row['date']; ?></strong></p>
                      </div>
                      
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal">Ok, Got it</button>
                  </div>
                  
              </div>
          </div>
      </div>
        </div>
        <!--End-->


      </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2020 All rights reserved. <a href="" class="font-weight-bold ml-1">Club Infinity</a>
            </div>
          </div>
          <div class="col-xl-6">
            
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>

  <!--?php echo $data = $row['mdate']; ?-->
	<script type="text/javascript">new CountUp('<?php echo $date; ?>','counter');</script>
</body>

</html>