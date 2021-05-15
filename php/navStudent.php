<?php
date_default_timezone_set('Asia/Manila');
include('db_conn.php');

//SESSION TIMER
$idletime=60*60;//after 1 hr the user gets logged out
if (time()-$_SESSION['timestamp']>$idletime){
    //$_GET['inactivityError'] = "Session ended: You are logged out due to inactivity.";
    header("Location: StudentLogout.php?error=timeout");
}else{
    $_SESSION['timestamp']=time();
}
require_once 'Student_vtValSan.php';
// //Function to Check user details is valid
// function isValidUserr($conn){  // checks if user is registered
//     $studd_id = $conn->real_escape_string($_SESSION['student_id']);
//     $voter = $conn->query("SELECT * FROM student WHERE student_id = $studd_id");
//     $poss = $voter->fetch_assoc();
//     // echo $studd_id;
//     // echo $poss["fname"]." ".$poss["lname"]." ".$poss["student_id"];
//     if($poss != NULL && ($poss["lname"] === $_SESSION['lname'] && $poss["fname"] === $_SESSION['fname'] && $poss["student_id"] == $_SESSION['student_id'] && $poss["bumail"] === $_SESSION['bumail'])){
//         return true;
//     }
//     else{
//         return false;
//     }
// }//end function

// //NOTIFY ADMIN
// function notifyAdminn($text){
//     if($text != ""){
//         date_default_timezone_set("Asia/Singapore");
//         $session_info = "<br><br>More info about the sender: <br>Student Name: ".$_SESSION['fname']." ".$_SESSION['lname'].
//         "<br>Grade Level: ".$_SESSION['grade_level'].
//         "<br>Email: ".$_SESSION['bumail'].
//         "<br>Student ID: ".$_SESSION['student_id'].
//         "<br>TIme Attempted: ".date("h:i:sa");
//         $text_message = "1||".$text.$session_info."||".date('h:i')."||".date('Y/m/d')."||unread"."##\n";
//         $file = "../user/msg/system.html";
//         file_put_contents($file, $text_message, FILE_APPEND | LOCK_EX);
//     }
// }//END NOTIFY

//USER CHECKING
if(!(isValidUser($conn))){
    // Invalid user; destroy session and return to login
    notifyAdmin("Warning: A user with invalid credentials attempted to access the system");
    header("location: StudentLogout.php");
}//end checking
 ?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/student_css/style_studNav.css">
    <!-- <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_AdminDash.css"> -->
    <!-- <link rel="stylesheet" href="../css/admin_css/font-awesome_AdminDash.css"> -->
    
    <!-- <link rel="stylesheet" type="text/css" href="../css/admin_css/style1_addAdmin.css"> -->
    <!-- <link rel="stylesheet" href="../css/admin_css/bootstrap_addAdmin.css"> -->
    <link rel="stylesheet" href="../css/student_css/bootstrap_studNav.css">
    <!-- <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap_addAdmin.css"> -->
    <!-- <link rel="stylesheet" href="../css/admin_css/font-awesome_addAdmin.css">  -->
    <link rel="stylesheet" type="text/css" href="../css/student_css/modal_error_messages.css">
    <!-- for disabling inspect element -->
    <!-- <script src="../js/scripts_vote.js"></script> -->
</head>

<body>
    <!--navbar-->
    <nav>
        <input class="nav-toggle1" type="checkbox">
        <div class="aLogo">
            <h2 class="aLogo-txt1"><a href="Student_studDash.php">BUCEILS HS</a></h2>
            <h3 class="aLogo-txt2"><a href="Student_studDash.php">ONLINE VOTING SYSTEM</a></h3>
        </div>
        <label for="btn" class="ADicon"><span class="fa fa-bars"></span></label>
        <input class="nav-toggle2" type="checkbox" id="btn">
        <ul>
             <li>
                <label for="btn-1" class="Ashow"><a id="Ashow1" href="Student_vtBallot.php">VOTE</a></label>
                <a href="Student_vtBallot.php">VOTE</a>
            </li>

            <li>
                <label for="btn-2" class="Ashow">ELECTION</label>
                <a href="#">ELECTION</a>
                <input class="nav-toggle4" type="checkbox" id="btn-2">
                <ul>
                    <li><a href="#">PROCESS</a></li>
                    <li><a href="Student_ArcFolder.php">ARCHIVE</a></li>
                    <li><a href="Student_ElectStat.php">RESULTS</a></li>
                </ul>
            </li>
           
            <li>
                <label for="btn-3" class="Ashow"><a id="Ashow1" href="Student_CandView.php">CANDIDATES</a></label>
                <a href="Student_CandView.php">CANDIDATES</a>
            </li>

            <li>
                <label for="btn-4" class="Ashow"><a id="Ashow1" href="Student_Mbox.php">CHAT US</a></label>
                <a href = "Student_Mbox.php">CHAT US</a>
            </li>

            <li>
                <label for="btn-5" class="Ashow"><img class="Auser-profile" src="../img/user.png"></label>
                <a class="user" href="#"><img class="Auser-profile" src="../img/user.png"></a>
                <input class="nav-toggle4" type="checkbox" id="btn-5">
                <ul>
                    <li><a class="username" href="#"><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?> </a></li>
                    <li><a href="StudentLogout.php">LOGOUT</a></li>
                </ul>
                
            </li>
        </ul>
        <!--end of list-->
    </nav>

        <!-- MODAL -->
        <div class="modal fade" id="logout" tabindex="1" role="dialog" aria-labelledby="logout" aria-hidden="true">
          <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h2 class="modal-title custom_align" id="Heading"><b>SESSION TIMEOUT</b></h2>
    </div>
          <div class="modal-body">             
          <div><h3>You have been logged out due to inactivity.</h3></div>
    </div>
        <div class="modal-footer ">
        <button type="submit" name="continue-btn" class="btn btn-warning" id="continue" ><span "></span><h4> Continue</h4></button>
      </div>    
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    <!-- ENDMODAL -->


    <!-- Error Message Modal content -->
    <div id="No-election-scheduled" class="F-modal-error">
        <div class="F-modal-content-error">
          <div class="F-modal-header-error">
          </div>
          <div class="F-modal-body-error">
            <p id = "F-modal-message-text">.</p>
          </div>
          <div class="F-modal-footer-error">
            <button type="button" id="ok-button" class="F-OkBTN-error">OK</button>
          </div>
        </div>
    </div>
    <!-- for modal script and disabling inspect element -->
    <!-- <script src="../js/scripts_nav.js"></script> -->


    <div class="footer">
        <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
    </div>

    <!--End of Footer-->
    <noscript>
         Your browser does not support JavaScript!
      </noscript>
   
</body>

</html>
