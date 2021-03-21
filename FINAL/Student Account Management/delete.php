<?php

	session_start();

    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'seproject');

        if (isset($_POST['continue'])) {

                $student_id = $_POST['Delete_ID'];
				$query = "DELETE FROM student WHERE student_id ='$student_id'";
				$query_run = mysqli_query($connection, $query);
				
                if ($query_run) {
                    $_SESSION['message'] = 'Record has been deleted!';
                    $_SESSION['msg_type'] = 'danger';
                    header("location: StudentAccountManagement.php");
                }
                else{
                    $_SESSION['message'] = 'Record has not been deleted!';
                    $_SESSION['msg_type'] = 'warning';
                    header("location: StudentAccountManagement.php");
                }        
        }
?>