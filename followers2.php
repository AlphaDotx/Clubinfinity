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
  <title>Downliners - Cub Infinity</title>
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
      <a class="navbar-brand pt-0" href="./index.html">
        <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
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
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="provide.php">
              <i class="ni ni-planet text-blue"></i> Provide Help
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="followers.php">
              <i class="ni ni-planet text-blue"></i> Downliners
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="ni ni-pin-3 text-orange"></i> Log Out
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Downliners</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
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
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
<?php
if($row['userStatus'] == "Y"){
    
?>
<div class="alert alert-default alert-dismissible fade show" role="alert">
                 <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                   <span class="alert-inner--text"><strong>info!</strong> Your referral link: http://www.clubinfinity.co.za/register.php?code=<?php echo base64_encode($row['userName']); ?></span>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                  </button>
            </div>
<?php
}
?>
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
  }
}
?>

            <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Downliner's Table</h3>
                </div>
                
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Full names</th>
                    <th scope="col">Status</th>
                    <th scope="col">Pending</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
<?php                                
$stmt = $user_home->runQuery("SELECT * FROM tbl_users");
$stmt->execute(array(":uid"=>$row['userName']));
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
?>
                  <tr>
                    
      <td><?php echo $row['userName']; ?></a></td>
      <td><?php echo $row['Name']; ?></td>
       
      <td><?php echo $row['userStatus']; ?></td>
                                                
       <td>
           <?php
           if($user_home -> Check_tempPH($row['userID']) > 0){
               echo "R200";
           }else{
               echo "R0";
           }
           ?>
       </td>
       
<td>
           <?php
           if($user_home -> Check_tempPH($row['userID']) > 0){
               echo '<a  href="confirm_ph.php?trace='.$row['userID'].'" class="btn btn-outline-warning">Confirm</button>';
           }else{
               echo '...';
           }
           ?>    


</td>
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



      </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 <a href="" class="font-weight-bold ml-1">X Creatives</a>
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