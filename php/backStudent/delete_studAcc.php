<!-- Proj Mngr Notes:
- change connection to host
- changed db name for local testing
- changed header location

-->

<?php

	session_start();

    include "../db_conn.php";

    // $connection = mysqli_connect("localhost", "root", "");
    // $db = mysqli_select_db($connection, 'bucielsmain2');

        if (isset($_POST['continue'])) {

                $student_id = $_POST['Delete_ID'];
                $query = "SET foreign_key_checks = 0;";
                $connect->query($query);
				$query = "DELETE FROM student WHERE student_id ='$student_id'";
				$query_run = mysqli_query($conn, $query);
                $query = "SET foreign_key_checks = 1;";
                $connect->query($query);
				
                if ($query_run) {
                    $_SESSION['message'] = 'Record has been deleted!';
                    $_SESSION['msg_type'] = 'danger';
			
		//For Logs
		$_SESSION['action'] = 'deleted Info of Student : ' . $student_id;
		include '../backAdmin/backFun_actLogs_v0_1.php';
			
                    header("location: ../Admin_studAcc.php");
                }
                else{
                    $_SESSION['message'] = 'Record has not been deleted!';
                    $_SESSION['msg_type'] = 'warning';
                    header("location: ../Admin_studAcc.php");
                }        
        }
?>
