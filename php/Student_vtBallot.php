<?php
session_start();
include('db_conn.php');
 if (isset($_SESSION['student_id']) && isset($_SESSION['bumail'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" href="../css/student_css/bootstrap_vote.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/bootstrap.min-vote.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/bootstrap_vote.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/vote_ballot.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/scripts_vote.js"></script>
    <script type="text/javascript" src="../js/student_session_timer.js"></script>
    <title>Vote  | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php
        // include "db_conn.php";
        // require_once 'Student_vtValSan.php';
        require 'Student_vtFetch.php';

        // Remove this temp session
        
        if(isValidUser($conn)){
            $sched_row = $conn->query("SELECT * FROM `vote_event` WHERE `vote_event_id` = 1 LIMIT 1");
            $sched = $sched_row->fetch_assoc();
            $start_time = strtotime($sched['start_date']);
            $end_time = strtotime($sched['end_date']);
            $access_time = time();
            if(isVoted($conn)){// If already voted
                if(empty($sched)){
                    errorMessage("No election has been scheduled");
                    exit();
                }
                
                if($access_time < $start_time){
                    notifyAdmin("Warning: A user was marked as \"Voted\" even when the election has not yet started. Their voting status and their votes were automatically reset.");
                    errorMessage("Election has not yet started");
                    exit();
                }

                header("Location: Student_vtReceipt.php");
                exit();
            }
            
            if(empty($sched)){
                errorMessage("No election has been scheduled");
                exit();
            }

            $start_time = strtotime($sched['start_date']);
            $end_time = strtotime($sched['end_date']);
            $access_time = time();

            // echo "Start: ".(date("Y-m-d h:m:sa", $start_time))."<br>";
            // echo "End: ".(date("Y-m-d h:m:sa", $end_time))."<br>";
            // echo "Now: ".(date("Y-m-d h:m:sa", $access_time))."<br>";
            
            if($access_time > $end_time){
                errorMessage("The election is already closed. Your can no longer cast your votes.");
                exit();
            }
            else if($access_time < $start_time){
                errorMessage("Election has not yet started.");
                exit();
            }
            else if($access_time >= $start_time && $access_time <= $end_time){
                require_once 'navStudent.php';
                echo '<header id="F-header"  style="text-align: center;"><b>STUDENT LEADER ELECTION</b></header><br>';
                echo '<main>';
                echo '<form id = "main-form" method="POST" action = "Student_vtReceipt.php" class="vtBallot" id="vtBallot"><div id="voting-page">';

                $table = $conn->query("SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) ORDER BY candidate_position.heirarchy_id"); // get positions
                
                generateBallot($table);
                require 'Student_vtConfirm.php';
                echo '</div>';
                echo '<div id="vote-button"><button id="vote-btn" name = "vote-button" class="vote-btn" type = "button">SUBMIT</button></div>
                </form>';
                echo '</main>';
                echo '<br>
                <script src = "../js/modals_vote.js"></script>';
                echo '<script>
                    var myVar = setInterval(myTimer, 1000);
                    function myTimer() {
                        var d = new Date();
                        if('.$end_time.' <= parseInt(d.getTime()/1000)){
                            window.location.reload();
                        }
                    }
                    </script>';
                
            }
        }
        else{// Invalid user; destroy session and return to login
            notifyAdmin("Warning: A user with invalid credentials attmpted to access the Voting Page");
            header("Location: StudentLogout.php");
            exit();
        }
    ?>
 </body>

</html>
<?php
}else{
	header("Location: ..\index.php");
     exit();
}
 ?>