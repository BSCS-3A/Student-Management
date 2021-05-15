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
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" href="../css/student_css/bootstrap_vote.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/vote_message.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/messages.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="../js/student_session_timer.js"></script>
    <title>Download Vote Receipt | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php
        // include 'navstudent.php';
        // require "db_conn.php";
	      // require_once "Student_vtValSan.php";
        // if(!isset($_POST['confirm-button'])){
        //   header("Location: vtBallot.php");
        //   exit();
        // }



        function receiptMsg($message){
          require_once 'navStudent.php';
          echo '<header id="F-header"  style="text-align: center;"><b>VOTE RECEIPT</b></header><br>';
            echo '<main>';
            echo '<div id="download-receipt-page" class="F-download-receipt-container">';
            echo '<div class="F-receipt-message">';
            echo "<h3>".$message."</h3>";
            echo '</div></div>';
            echo '<div id="receipt-page-buttons" class="F-receipt-page-buttons">
            <button type="button" class="F-downloadReceiptBTN" id="F-downloadReceiptBTN">Download Receipt</button>
            <button type="button" class="F-goToHomeBTN" id="F-goToHomeBTN">Go to Home</button>
          </div>
        </main>';
        }
        if(isValidUser($conn)){
          if(!isVoted($conn)){
            $sched_row = $conn->query("SELECT * FROM `vote_event` WHERE `vote_event_id` = 1");
            $sched = $sched_row->fetch_assoc();
    
            
            if(empty($sched)){
              notifyAdmin("Warning: Someone has attmpted to access the Receipt Page bafore the scheduled election!");
              errorMessage("Suspicious behavior detected! Attempted to submit votes without a scheduled election. Your actions have been reported to the admins.", "Student_studDash.php");
            }
            else{
              $start_time = strtotime($sched['start_date']);
              $end_time = strtotime($sched['end_date']);
              $access_time = time();
    
              if($access_time > $end_time){
                  errorMessage("Sorry. You can no longer submit your votes. Election is already finished", "Student_studDash.php");
              }
              else if($access_time < $start_time){
                notifyAdmin("Warning: Someone has attmpted to access the Receipt Page bafore the scheduled election!");
                errorMessage("Suspicious behavior detected! Attempted to submit votes before the start of the elections. Your actions have been reported to the admins.", "Student_studDash.php");
              }
              else if($access_time >= $start_time && $access_time <= $end_time){
                // require "Student_vtSubmit.php";

                //----------------Submit Votes
                $table = $conn->query("SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) ORDER BY candidate_position.heirarchy_id"); // get positions
	
                $choice_final = array();
                $vote_table = array();

                // Sanitation and Validation
                mysqli_data_seek($table, 0);
                $stud_id = $_SESSION['student_id'];
                $status = "";
                if(isset($_POST['confirm-button'])){
                  while($poss = $table->fetch_assoc()){   // loop through all positions
                    if(($poss["vote_allow"] == 0 && $_SESSION['grade_level'] == $poss["grade_level"]) || $poss["vote_allow"] == 1){
                      if(empty(filter_var($_POST[$poss['heirarchy_id']], FILTER_SANITIZE_STRING))){
                        $choice = 0;
                      }
                      else{
                        $_POST[$poss['heirarchy_id']] = filter_var(stripslashes($_POST[$poss['heirarchy_id']]), FILTER_SANITIZE_STRING);;
                        $choice = cleanInput(stripslashes($_POST[$poss['heirarchy_id']]));
                      }
                
                      if(isValidCandidate($conn, $choice, $poss['heirarchy_id'])){
                        if($poss['candidate_id'] == $choice){
                          $choice_final[$poss['heirarchy_id']] = $poss['candidate_id'];
                          $status = "Voted";
                        }
                        else{
                          $status = "Abstain";
                        }
                      }
                      else{
                        // Submit records marked invalid
                        mysqli_data_seek($table, 0);
                        while($poss = $table->fetch_assoc()){
                          $cand_id = $conn->real_escape_string($poss['candidate_id']);
                          $stud_id = $conn->real_escape_string($stud_id);
                          $conn->query("INSERT INTO `vote` (`vote_log_id`, `student_id`, `candidate_id`, `status`, `time_stamp`) VALUES (NULL, $stud_id, $cand_id, 'Invalid', current_timestamp())");
                        }
                        // update voter's status
                        $conn->query("UPDATE `student` SET `voting_status` = true WHERE `student`.`student_id` = '$stud_id'");
                        // notify admin
                        notifyAdmin("Warning: An attempt to submit a tampered ballot was made! The user was automatically banned from voting.");
                        // notify admin & return to ballot
                        errorMessage("Ballot tampering detected. You have been banned from voting and have been reported to the admins.", "Student_studDash.php");
                        exit();
                      }
                    }
                    else{
                      $status = "Abstain";
                    }
                    $vote_table[$poss['candidate_id']] = $status;
                  }
                
                  // Submission	
                  foreach($choice_final as $value){
                    $candidate = $conn->real_escape_string($value);
                    $conn->query("UPDATE candidate SET total_votes = total_votes + 1 WHERE candidate.candidate_id = $candidate");	
                  }
                
                  mysqli_data_seek($table, 0);
                  while($poss = $table->fetch_assoc()){
                    $status = $conn->real_escape_string($vote_table[$poss['candidate_id']]);
                    $cand_id = $conn->real_escape_string($poss['candidate_id']);
                    $stud_id = $conn->real_escape_string($stud_id);
                    $conn->query("INSERT INTO `vote` (`vote_log_id`, `student_id`, `candidate_id`, `status`, `time_stamp`) VALUES (NULL, $stud_id, $cand_id, '$status', current_timestamp())");
                  }
                  
                
                  // update voter's status
                  $conn->query("UPDATE `student` SET `voting_status` = true WHERE `student`.`student_id` = '$stud_id'");
                  receiptMsg("Your votes were submitted successfully! Here is a copy of your vote receipt");
                }
              }
            } 
          }
          else{ // Already Voted
            receiptMsg("You have already voted. Here is a copy of your vote receipt.");
          }
        }
        else{ // Invalid user; destroy session and return to login
          notifyAdmin("Warning: A user with invalid credentials attmpted to access the Receipt Page!");
          header("Location: StudentLogout.php");
          exit();
        }
      ?>
              <!-- <embed src="PDF/generatepdf.php" width="600px" height="800px" /> -->
      <script>
            // Get Download Receipt button
            var download = document.getElementById("F-downloadReceiptBTN");
    
            // Get Home button
            var home = document.getElementById("F-goToHomeBTN");
    
            download.onclick = function() {
            location.href = "Student_vtGeneratepdf.php"; // generate reciept & show receipt
            }
    
            home.onclick = function() {
            location.href = "Student_studDash.php";
            }
      </script>
    </body>
    </html>
<?php
}else{
	header("Location: ..\index.php");
     exit();
}
 ?>