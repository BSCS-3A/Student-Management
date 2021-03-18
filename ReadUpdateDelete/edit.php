<?php

    session_start();
    
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'seproject');

        if (isset($_POST['save'])) {

                $student_id = $_POST['Update_ID'];
                $last_name = $_POST['last_name'];
                $first_name = $_POST['first_name'];
                $gender = $_POST['gender'];
                $grade_level = $_POST['grade_level'];
                $email = $_POST['email'];

                $query = "UPDATE stud_info SET last_name = '$last_name', first_name = '$first_name',  gender = '$gender', grade_level = '$grade_level', email = '$email' 
                         WHERE student_id = '$student_id' ";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    $_SESSION['message'] = 'Record has been updated!';
                    $_SESSION['msg_type'] = 'success';
                    header("location: form.php");
                }
                else{
                    $_SESSION['message'] = 'Record has not been updated!';
                    $_SESSION['msg_type'] = 'danger';
                    header("location: form.php");
                }
        }

?>