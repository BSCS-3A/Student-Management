<!-- Proj Mngr notes
- change connection for host
- changed header location
-->

<?php

    session_start();
    include "db_conn.php";

    // $connection = mysqli_connect("localhost", "root", "");
    // $db = mysqli_select_db($connection, 'bucielsmain2');

        if (isset($_POST['save'])) {

                $student_id = $_POST['Update_ID'];
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $Mname = $_POST['Mname'];
                $gender = $_POST['gender'];
                $bumail = $_POST['bumail'];
                $grade_level = $_POST['grade_level'];

                $query = "UPDATE student SET lname = '$lname', fname = '$fname', Mname = '$Mname', gender = '$gender', bumail = '$bumail', grade_level = '$grade_level'
                         WHERE student_id = '$student_id' ";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    $_SESSION['message'] = 'Record has been updated!';
                    $_SESSION['msg_type'] = 'success';
                    
                    //For Logs
                    $_SESSION['action'] = 'updated Info of Student : ' . $student_id;
                    include 'backFun_actLogs_v0_1.php';
                    
                    header("location: Admin_studAcc.php");
                }
                else{
                    $_SESSION['message'] = 'Record has not been updated!';
                    $_SESSION['msg_type'] = 'warning';
                    header("location: Admin_studAcc.php");
                }
        }

?>
