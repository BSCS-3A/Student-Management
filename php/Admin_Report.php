<!--ELECTION RESULTS REPORT (ADMIN)-->
<!-- This file enables winners to be inserted to archive -->
<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="../css/admin_css/style_monitor.css">
        <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_monitor.css">
        <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_monitor.css">
        <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
        <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_monitor.css">
        <script src="../js/dataTables.bootstrap4.min_monitor.js"></script>
        <script src="../js/jquery-3.5.1_monitor.js"></script>
        <script src="../js/jquery.dataTables.min_monitor.js"></script>
        <script type="text/javascript" src="../js/admin_session_timer.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
      
        <!--       Tie Breaker UI -->
        <link rel="stylesheet" type="text/css" href="../css/student_css/vote_ballot.css">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="../js/scripts.js"></script>
      
        <title>Election Report Generation  | BUCEILS HS Online Voting System</title>
    </head>

    <body>
      <?php
            require './backMonitor/fetch_date.php';                        // Fetches important datetime
            require './backMonitor/student_count.php';                     // Counts student
            require './backMonitor/fetch_report.php';                      // Contains necessary functions and query
            // require '../php/vtFetch.php';
            include "navAdmin.php";                                 // Adds the navBar and footer
        ?>

    <div class="ADheader" id="ADheader">
        <h2 class="aHeader-txt">ELECTION REPORT</h2>
    </div>
      
        <?php
            // Count and store to Archive right after election
                if($current_date_time>$last_election_date)//change to automatically compute after election
                {
                    $winnerList = " WHERE 0";
                    $tiedCandidates = " WHERE 0";
                    $tiedStatus = 0;

                    for($i=1; $i<=$positionSize; $i++)
                    {
                        // Count the highest vote per position
                            $rowSQL = mysqli_query($conn, "SELECT MAX(total_votes) AS tempWinner FROM candidate WHERE position_id = '$i'");
                            list($max) = mysqli_fetch_row($rowSQL);

                        if($max>0)
                        {
                            $voteAllow=mysqli_fetch_array($result);
                            if($voteAllow['vote_allow']==1)
                            {// For non-representative positions
                                getLists($conn, $enrolled, '6', $i, $max, $tiedCandidates, $winnerList, $tiedStatus);
                            }else{// For representative positions
                                getLists($conn, $enrolled, getGradeLevel($conn, $i), $i, $max, $tiedCandidates, $winnerList, $tiedStatus);
                            } //end if else
                        }
                    }//end for loop

                    if($tiedStatus!=0)
                    {    // if headadmin
                        // while (($tiedStatus)!=0)
                        // {
                            if($_SESSION['admin_position'] == "Head Admin")
                            {
                                $queryString = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id)".$tiedCandidates." ORDER BY candidate_position.heirarchy_id";
                                $tieTable = $conn->query($queryString);
                                require 'Admin_tieBreaker.php';
                                $tempString = winString(2, $candidate);
                                $winnerList = $winnerList.$tempString;
                                // $tiedStatus = $tiedStatus - minus(2);
                                $tiedStatus = 0;
                            }else{ //ordinary admin
                                // display that election results is not yet final, call admin to finalize
                            }
                        // }
                        if($_SESSION['admin_position'] == "Head Admin")
                        {
                            $queryString = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id)".$tiedCandidates." ORDER BY candidate_position.heirarchy_id";
                            $tieTable = $conn->query($queryString);
                            require 'Admin_tieBreaker.php';
                        }else{ //ordinary admin
                            // display that election results is not yet final, call admin to finalize
                        }
                    }
                    else{
                        insertToArchive($conn, $winnerList, $last_election_date);
            ?>
                      <div class="Bbtn_dl">
                      <button onclick="parent.open('Admin_generate-pdf.php')" class='Bbtn_dlreport'"><b>DOWNLOAD PDF</b></button>
                      </div>'
                      <div class="Bbtn_save">
                      <button onclick="parent.open('Admin_generate-pdf.php')" class='Bbtn_save2arc'"><b>SAVE TO ARCHIVES</b></button>
                      </div>'


            <?php
                    }
                }
                else{
                    include '../html/ongoing.html';
                }       
            ?>

        <!-- Space before footer -->
        <br><br><br><br><br><br><br><br>

        <script>
            $('.icon').click(function() {
                $('span').toggleClass("cancel");
            });
        </script>
    </body>
</html>
<?php
}else{
    header("Location: AdminLogin.php");
     exit();
}
 ?>
