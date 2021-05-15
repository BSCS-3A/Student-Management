<?php
session_start();

// Create connection
include '../db_conn.php';

if (isset($_POST['saveAccount'])) {

  $admin_lname = $_POST['admin_lname'];
  $admin_fname = $_POST['admin_fname'];
  $admin_mname = $_POST['admin_mname'];
  $username = $_POST['username'];
  $admin_position = $_POST['admin_position'];
  $comelec_position = $_POST['comelec_position'];
  $password = $_POST['password'];
  $conpassword = $_POST['conpassword'];

  $data = $_POST['base64'];
  $image_array_1 = explode(";", $data);
  $image_array_2 = explode(",", $image_array_1[1]);
  $data = base64_decode($image_array_2[1]);
  $image_name = "../../user/img/" . uniqid('', true) . '.jpg';

  $duplicate = mysqli_query($conn, "select * from admin where username='$username'"); //add or for multiple attribute checking
  if (mysqli_num_rows($duplicate) > 0) {
    header("Location: ../Admin_adAccnt.php?message=User name or Email id already exists.");
  } else {
          file_put_contents($image_name, $data);

          // $hashed = password_hash($password, PASSWORD_DEFAULT);
          //insert into database
          $query = "INSERT INTO admin (`admin_lname`, `admin_fname`, `admin_mname`, `username`, `admin_position`, `comelec_position`, `password`, `photo`) 
          VALUES('$admin_lname', '$admin_fname', '$admin_mname', '$username', '$admin_position', '$comelec_position', '$password', '$image_name')";
          mysqli_query($conn, $query);

          //For Logs
          $_SESSION['action'] = 'created Admin Account : ' . $_POST['username'];
          include 'backFun_actLogs_v0_1.php';

          header("Location: ../Admin_adAccnt.php");
  }
}
?>