<?php

    session_start();
    include "db_conn.php";

    if (isset($_POST['add'])) {

        $student_id = $_POST['Add_ID'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $Mname = $_POST['Mname'];
        $gender = $_POST['gender'];
        $bumail = $_POST['bumail'];
        $grade_level = $_POST['grade_level'];

        $AddStudent = "INSERT into student(student_id, fname, Mname, lname, gender, bumail, grade_level, otp) values ('$student_id', '$fname', '$Mname', '$lname', '$gender', '$bumail', '$grade_level', '$otp')";
        $query_run = mysqli_query($conn, $AddStudent);

        if ($query_run) {
            $_SESSION['message'] = 'Record has been updated!';
            $_SESSION['msg_type'] = 'success';
            
            //For Logs
            $_SESSION['action'] = 'updated Info of Student : ' . $student_id;
            include 'backFun_actLogs_v0_1.php';
            
            header("location: Admin_studAcc.php");
        }
        else{
            $_SESSION['message'] = 'Record has not been added because it already exists.';
            $_SESSION['msg_type'] = 'warning';
            header("location: Admin_studAcc.php");
        }
    }
?>