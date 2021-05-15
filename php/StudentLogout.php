<?php 
session_start();
include "db_conn.php";
$student_id = $_SESSION['student_id'];
date_default_timezone_set('Asia/Manila');
                $date = date('Y-m-d');
				$time = date('H:i:s');
mysqli_query($conn, "INSERT INTO student_access_log(student_id,activity_description,date,time) VALUES($student_id,'Logout','$date','$time')");
session_unset();
session_destroy();

if(isset($_GET['error'])){
    header("Location: ..\index.php?session=timeout");
}else{
    header("Location: ..\index.php");
}
?>