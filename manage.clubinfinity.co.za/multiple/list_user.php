<?php
session_start();
require_once '../class.user.php';
require_once '../dbconfig.php';
require_once '../config.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('../index.php');
}

?>
<html>
<head>
<title>Users List</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script language="javascript" src="users.js" type="text/javascript"></script>
</head>
<body>
<form name="frmUser" method="post" action="">
<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tblListForm">
<tr class="listheader">
<td></td>
<td>Trace ID</td>
<td>Username</td>
<td>Amount</td>
<td>Bank</td>
<td>Date</td>
</tr>
<?php
date_default_timezone_set('Africa/Johannesburg');
$date = date('Y-m-d', time());

$i=0;
$result = mysql_query("SELECT * FROM tbl_orders WHERE date < '$date' ORDER BY `tbl_orders`.`date` ASC");
 echo   mysql_error();
while($row = mysql_fetch_array($result)) {
 echo   mysql_error();
if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><input type="checkbox" name="users[]" value="<?php echo $row["userID"]; ?>" ></td>
<td><?php echo $row["traceid"]; ?></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["price"]; ?></td>
<td><?php echo $row["status"]; ?></td>
<td><?php echo $row["date"]; ?></td>
</tr>
<?php
$i++;
}
?>
<tr class="listheader">
<td colspan="7"><input type="button" name="update" value="Release Selected" onClick="setUpdateAction();" />
 <!--input type="button" name="delete" value="Delete"  onClick="setDeleteAction();" /></td-->
</tr>
</table>
</form>

</body></html>