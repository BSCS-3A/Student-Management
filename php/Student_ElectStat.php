<?php
session_start();
include('db_conn.php');
 if (isset($_SESSION['student_id']) && isset($_SESSION['bumail'])) {
 ?>
<?php require './backMonitor/fetch_date.php' ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" href="../css/student_css/bootstrap_monitor.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/student_css/style.css"> -->
    <link rel="stylesheet" href="../css/student_css/style_monitor.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script src="assets/js/countdown.js"></script> -->
    <script type="text/javascript" src="../js/student_session_timer.js"></script>
    <title>Election Results  | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php
        // require 'connect.php'; // Remove this when compiling
        require_once 'Student_vtValSan.php';
        
        /*<div class="bheader">
        <h3>
          ELECTION STATUS
        </h3>
        </div>*/
        
        if(isValidUser($conn)){
            if(empty($row['vote_event_id'])){
                errorMessage("No election has been scheduled");
                exit();
            }
            else{
                $start_time = strtotime($row['start_date']);
                $end_time = strtotime($row['end_date']);
                $access_time = time();
                if($access_time > $end_time){
                    if($postB==1){
                        require_once 'navStudent.php';
                        require 'Student_ElectRes.php';
                    }else{
                        errorMessage("Election is already finished");
                        exit();
                    }
                }else if($access_time < $start_time){
                    errorMessage("Election has not yet started");
                    exit();
                }
                else if($access_time >= $start_time && $access_time <= $end_time){
                    errorMessage("Election  is still on-going");
                    exit();
                }
            }
        }
        else{ // Invalid user; destroy session and return to login
            notifyAdmin("Warning: A user with invalid credentials attmpted to access the Election Page");
            session_unset();    // remove all session variables
            session_destroy();  // destroy session
            header("Location: ../index.php");
            exit();
        }
    ?>

    <script>
        $('.icon').click(function () {
            $('span').toggleClass("cancel");
        });
    </script>
</body>

</html>
<?php
}else{
	header("Location: ..\index.php");
     exit();
}
 ?>