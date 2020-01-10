<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
//-------------Database Connection----------//
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
	

//------------------------Audit Trail---------------//
public function getUser($id){

	$sql = "SELECT userName FROM `tbl_users` WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$user = $result->fetchColumn(); 
	return $user;
}

public function auditTrail($userID,$justification,$date){

	try
	{							
		$stmt = $this->conn->prepare("INSERT INTO tbl_audit_trail(userID,justification,created_at) 
													 VALUES(:user_id, :justification, :date)");

		$stmt->bindparam(":user_id",$userID);
		$stmt->bindparam(":justification",$justification);
		$stmt->bindparam(":date", $date);
		$stmt->execute();	
		return $stmt;
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}  
}
//-----------------------------------------------//

//-------------Dashboard Statistic------------//
//--------------------------------------------//

//------------Counting Orders-----------//
public function CountOrders(){

	$sql = "SELECT COUNT(*) FROM `tbl_orders`"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//------------Counting Pending-----------//
public function CountPending(){

	$sql = "SELECT COUNT(*) FROM `tbl_history` WHERE status=0"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//------------Counting Users-----------//
public function CountUsers(){

	$sql = "SELECT COUNT(*) FROM `tbl_users`"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//------------Counting Investments-----------//
public function CountInvestment(){

	$sql = "SELECT COUNT(*) FROM `tbl_waitinglist`"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}

//------------Counting PH-----------//
public function CountPH(){

	$sql = "SELECT COUNT(*) FROM `tbl_helpers`"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	$num_rows = $result->fetchColumn(); 
	return $num_rows;
	}


//------------End----------------//

//----------Temp Confirmation-----------------//
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

//----------------Approving users----------------//
//----------------------------------------------//
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


//----------------------Transaction History-------------------//
//------------------------------------------------------------//

//----------Confirmation of Funds-----------------//
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

//----------------------Allocation Adding to history---------------//
public function Addhistory($userid,$myid,$traceid,$from,$to,$offer,$status,$date){
	try
	{							
		$stmt = $this->conn->prepare("INSERT INTO tbl_history(userid,myid,traceid,hfrom,hto,amount,status,date) 
													   VALUES(:user_id, :myid, :trace_id, :from, :to, :amount, :status, :date)");
		$stmt->bindparam(":user_id",$userid);
		$stmt->bindparam(":myid",$myid);
		$stmt->bindparam(":trace_id",$traceid);
		$stmt->bindparam(":from",$from);
		$stmt->bindparam(":to",$to);
		$stmt->bindparam(":amount",$offer);
		$stmt->bindparam(":status",$status);
		$stmt->bindparam(":date",$date);
		$stmt->execute();	
		return $stmt;
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}
}

//------------End----------------//



//-----------------------Users--------------------------------//
//------------------------------------------------------------//

//----------------------Activate/ Block/ Suspend--------------//
public function updateStatus($status,$id){
	try{
	$sql = "UPDATE tbl_users SET userStatus='$status' WHERE userID='$id'"; 
	$result = $this -> conn->prepare($sql); 
	$result->execute(); 
	return true;
	}catch(PDOException $ex){
		echo $ex->getMessage();
	}
}

//------------------------Adding users to Orders---------------//

public function addOrders($userID,$username,$amount,$bank,$date){

	try
	{							
		$stmt = $this->conn->prepare("INSERT INTO tbl_orders(userID,name,price,bank,date) 
													 VALUES(:user_id, :user_name, :amount, :bank, :date)");

		$stmt->bindparam(":user_id",$userID);
		$stmt->bindparam(":user_name",$username);
		$stmt->bindparam(":amount",$amount);
		$stmt->bindparam(":bank",$bank);
		$stmt->bindparam(":date", $date);
		$stmt->execute();	
		return $stmt;
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}  
}

//------------------------------------------------------------//

//----------------------Sign Up-------------------------------//
	public function register($uname,$name,$contact,$email,$upass,$code,$bank,$account_no,$account_type,$branch,$branch_code)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,Name,Contact,userEmail,userPass,tokenCode,bank,account_no,account_type,branch,branch_code) 
			                   VALUES(:user_name, :name_user, :contact_number, :user_mail, :user_pass, :active_code, :bank, :account_no, :account_type, :branch, :branch_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":name_user",$name);
			$stmt->bindparam(":contact_number",$contact);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
            
            $stmt->bindparam(":bank",$bank);
            $stmt->bindparam(":account_no",$account_no);
            $stmt->bindparam(":account_type",$account_type);
            $stmt->bindparam(":branch",$branch);
            $stmt->bindparam(":branch_code",$branch_code);
            
            $stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	
//--------------Sign In----------//
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
					header("Location: index.php?pending");
					exit;
				}
				elseif($userRow['userStatus']=="N")
				{
				        header("Location: index.php?inactive");
				        exit;
				}
				elseif($userRow['userStatus']=="X")
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
	
      
//---------Session Verifier---------------//    
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
	
//----------Sign Out--------//
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	
}
?>