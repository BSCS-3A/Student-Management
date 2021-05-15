<?php 
session_start();
include "db_conn.php";
$admin_id = $_SESSION['admin_id'];
date_default_timezone_set('Asia/Manila');
                $date = date('Y-m-d');
				$time = date('H:i:s');
				mysqli_query($conn, "INSERT INTO admin_activity_log(admin_id,activity_description,activity_date,activity_time) VALUES('$admin_id','Logout','$date','$time')");
//setcookie("admin_id", "", time() -3600,"/", "buceilsvoting.online", 1);
//setcookie("username", "", time() -3600,"/", "buceilsvoting.online", 1);
session_unset();
session_destroy();

if(isset($_GET['error'])){
	header("Location: AdminLogin.php?session=timeout");
}else{
	header("Location: AdminLogin.php");
}
?>