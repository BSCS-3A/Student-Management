<?php

    session_start();
    
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'seproject');

        if (isset($_POST['save'])) {

                $student_id = $_POST['Update_ID'];
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $Mname = $_POST['Mname'];
                $gender = $_POST['gender'];
                $grade_level = $_POST['grade_level'];
                $bumail = $_POST['bumail'];

                $query = "UPDATE student SET lname = '$lname', fname = '$fname', Mname = '$Mname', gender = '$gender', grade_level = '$grade_level', bumail = '$bumail'
                         WHERE student_id = '$student_id' ";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    $_SESSION['message'] = 'Record has been updated!';
                    $_SESSION['msg_type'] = 'success';
                    header("location: StudentAccountManagement.php");
                }
                else{
                    $_SESSION['message'] = 'Record has not been updated!';
                    $_SESSION['msg_type'] = 'warning';
                    header("location: StudentAccountManagement.php");
                }
        }

?>