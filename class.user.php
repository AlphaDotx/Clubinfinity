<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}


//------------total help requested------/
public function request_stats($id){

    $amount = 0;
	$sql = "SELECT * FROM tbl_history WHERE userid='$id' AND status='1'";
	$stmt = $this -> conn->prepare($sql); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();

	while($row = $stmt->fetch()) {
		$amount += $row["amount"];
	}
return $amount;

}	

//------------total help provided------/
public function provide_stats($id){

    $amountFunds = 0;
	$sql = "SELECT * FROM tbl_history WHERE myid='$id' AND status='1'";
	$stmt = $this -> conn->prepare($sql); 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();

	while($row = $stmt->fetch()) {
		$amountFunds += $row["amount"];
	}
return $amountFunds;

}

//--------------Checking for Upliner details---------//

public function Check_Existing_User($user){

	$sql = "SELECT COUNT(*) FROM `tbl_users` WHERE userName='$user'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
    
}

//----------Withdwrawing investment-----------------//
public function withdrawal($traceid){
	try{
	$sql = "DELETE FROM tbl_waitinglist WHERE traceid='$traceid'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}

//----------Updating PH-----------------//
public function updatePH($price,$trace){
	try{
	$sql = "UPDATE tbl_helpers SET price='$price' WHERE traceid='$trace'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}


//----------Updating PH-----------------//
public function updateUser($user){
	try{
	$sql = "UPDATE tbl_users SET userStatus='Y' WHERE userID='$user'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}

//----------Confirmation-----------------//
public function ConfirmFunds($status,$trace){
	try{
	$sql = "UPDATE tbl_history SET status='$status' WHERE traceid='$trace'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}



//----------Confirmation-----------------//
public function ConfirmTemp($trace){
	try{
	$sql = "DELETE FROM tbl_temp_helpers WHERE userID='$trace'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}

//-----------counting the total number of ph per person-----------//
public function GrowingFunds($id){

	$sql = "SELECT price FROM `tbl_waitinglist` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$funds = $result->fetchColumn(); 
	return $funds;
	
	}

//-----------Retrieving kept funds-----------//
public function KeptFund($id){

$sql = "SELECT price FROM `tbl_kept` WHERE userID='$id'"; 
$result = $this -> conn->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows;
}

//------------Checking temp pending PH-----------//
public function Check_tempPH($id){

	$sql = "SELECT COUNT(*) FROM `tbl_temp_helpers` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//------------Checking Existing PH-----------//
public function CheckPH($id){

	$sql = "SELECT COUNT(*) FROM `tbl_helpers` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//-------------Registering----------//
	public function register($uname,$name,$contact,$upass,$code,$bank,$account_no,$keep,$refferal)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,Name,Contact,userPass,tokenCode,bank,account_no,keep,refferal) 
			                   VALUES(:user_name, :name_user, :contact_number, :user_pass, :active_code, :bank, :account_no, :keep, :refferal)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":name_user",$name);
			$stmt->bindparam(":contact_number",$contact);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
            
            $stmt->bindparam(":bank",$bank);
            $stmt->bindparam(":account_no",$account_no);
			$stmt->bindparam(":keep",$keep);
            
			$stmt->bindparam(":refferal",$refferal);
			
            $stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			//echo $ex->getMessage();
		}
	}


//----------------------Allocation Adding to PH---------------//
public function follower($recruiter,$id,$date){
	try
	{							
		$stmt = $this->conn->prepare("INSERT INTO tbl_refferals(recruiter,follower,created_at) 
														 VALUES(:recruiter,:follower,:date)");
		$stmt->bindparam(":recruiter",$recruiter);
		$stmt->bindparam(":follower",$id);
		$stmt->bindparam(":date",$date);
		$stmt->execute();	
	
		return $stmt;
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}
}

public function Addhelpers($userID,$traceid,$username,$amount,$bank,$date){
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO tbl_helpers(userID,traceid,name,price,bank,date) 
			                                             VALUES(:user_id, :trace_id, :user_name, :amount, :bank, :date)");
			$stmt->bindparam(":user_id",$userID);
			$stmt->bindparam(":trace_id",$traceid);
			$stmt->bindparam(":user_name",$username);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":bank",$bank);
			$stmt->bindparam(":date",$date);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}  
}


//------------total investments-----------//
public function getRecruiter($id){

	$sql = "SELECT recruiter FROM `tbl_refferals` WHERE follower='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$recruiter = $result->fetchColumn(); 
	return $recruiter;

}

//------------Retrieve follower's username-----------//
public function getFollower($id){

	$sql = "SELECT userName FROM `tbl_users` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$follower = $result->fetchColumn(); 
	return $follower;

}

//------------Retrive follower's contact number-----------//
public function getFollowerContact($id){

	$sql = "SELECT Contact FROM `tbl_users` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$follower = $result->fetchColumn(); 
	return $follower;

}

//----------------------Approve follower--------------//
public function approveIncentive($id){
	try{
	$sql = "UPDATE tbl_refferals SET status=1 WHERE follower='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}


//----------------------Active user--------------//
public function activateFollower($id){
	try{
	$sql = "UPDATE tbl_users SET userStatus='Y' WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}
//--------------------Signing in-------------------//	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE Contact=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y"){
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				elseif($userRow['userStatus']=="O")
				{
					$recruiter = $this->getRecruiter($userRow['userID']);

					header("Location: index.php?response=".base64_encode($recruiter));
					exit;
				}
				elseif($userRow['userStatus']=="N")
				{
				        header("Location: index.php?blocked");
				        exit;
				}	
			}
			else
			{
				header("Location:index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
      
 //------------Logged in session-------------//   
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	
}
?>