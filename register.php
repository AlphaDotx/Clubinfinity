<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}

if(empty($_GET['code']) || !isset($_GET['code'])){
  $reg_user->redirect('index.php');
}

if(isset($_POST['btn-signup']))
{

  $date = @date("Y-m-d | H:m:s");

	$uname = trim($_POST['firstname']);
	$name = trim($_POST['lastname']);
	$contact = trim($_POST['contact']);
	$upass = trim($_POST['password']);
	$code = md5(uniqid(rand()));
	
	$keep = trim(@$_POST['keeper']);
	
    $bank = trim($_POST['bank']);
    $account_no = trim($_POST['account_no']);
    
     $refferal = base64_decode($_POST['referral']);

     
    
    if(empty($_POST['referral']) || $uname == $refferal || !isset($_POST['referral'])){ 
        
    	$msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <span class="alert-inner--icon"><i class="fas fa-exclamation-circle"></i></span>
                  <span class="alert-inner--text"><strong>Warning!</strong> you are not allowed to register without referral</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>';

      }else{
       
          
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE Contact=:email_id");
	$stmt->execute(array(":email_id"=>$contact));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <span class="alert-inner--icon"><i class="fas fa-exclamation-circle"></i></span>
              <span class="alert-inner--text"><strong>Warning!</strong> the phone number you entered exists.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
  }else
	{
		if($reg_user->register($uname,$name,$contact,$upass,$code,$bank,$account_no,$keep,$refferal)){
			$user_id = $reg_user->lasdID();		
			$key = base64_encode($user_id);
      
                  
      $reg_user->follower($refferal, $user_id, $date);
			
		 $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
     <span class="alert-inner--text"><strong>Success!</strong> Hi! '. $name . ', you have successfully joined infinity club.</span>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>'; 
		}
		else
		{
		$msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fas fa-exclamation-triangle"></i></span>
    <span class="alert-inner--text"><strong>Error!</strong> Username you are trying to use is already taken!</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';	
		}	

    }
	}

}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Sir Williams">
  <title>Register - Club Infinity</title>
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

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="">
          <img src="assets/img/brand/white.png" />
        </a>
        
        
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-banner py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light">Fill in your details to register with us.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-4">
              <h1>Sign up</h1></div>
         
            </div>
            <div class="card-body px-lg-5 py-lg-5">


            <?php if(isset($msg)){ 
              
              echo $msg; 

              $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
              $stmt->execute(array(":uid"=>$refferal));
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              ?>
                  <div class="alert alert-dismissible alert-info" role="alert">
              Please make a payment to your recruiter to the details below.
                  </div>
                  <div class="alert alert-dismissible alert-warning" role="alert">
                          <h4>RECRUITMENT FEE</h4>
                    
                          <strong>Recruiter:</strong> <?php echo $row['Name']; ?><br>
                          <strong>Contact No.:</strong> <?php echo $row['Contact']; ?><br>
                          <strong>Bank Name:</strong> <?php echo $row['bank']; ?><br>
                          <strong>Account No.:</strong> <?php echo $row['account_no']; ?><br>
                          <strong>Amount:</strong> R100<br>

                      </div>
              <?php
              }
              ?>
            <form role="form" method="post" action="">
              
              <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <input class="form-control" placeholder="Username" name="firstname" type="text" required>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="Full Names" name="lastname" type="text" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="Cell number" name="contact" type="text" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm Password" name="confirm" type="password" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Bank name" name="bank" type="text" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Account number" name="account_no" type="text" required>
                  </div>
                </div>

              
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    
                    <input class="form-control" placeholder="refferal" name="referral" value="<?php echo $_GET['code']; ?>" type="hidden">
                    <input class="form-control" value="<?php echo $_GET['code']; ?>" disabled=disabled type="text">
                  </div>
                </div>
                 
          <div class="row mt-3">
            <div class="col-12">
              <a href="index.php" class="text-light"><small>Already have an account?</small></a>
            </div>
          </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4" name="btn-signup">Create account</button>
                </div>
              </form>
            </div>
          </div>
   
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2019 All rights reserved. <a href="" class="font-weight-bold ml-1">Club Infinity</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
</body>

</html>