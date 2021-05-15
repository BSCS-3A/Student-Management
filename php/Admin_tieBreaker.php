<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <!-- <link rel="stylesheet" href="../css/student_css/bootstrap-vote.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome_vote.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/bootstrap.min-vote.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/bootstrap_vote.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/student_css/vote_ballot.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/scripts.js"></script>
    <title>BUCEILS HS Vote</title>
</head>

<body>
    <?php
        require 'db_conn.php'; // Remove this when compiling
        // require 'Admin_vtValSan.php';
        require 'Admin_vtFetch.php';
        include './backMonitor/fetch_date.php';
                     if($current_date_time>$last_election_date){
                        //include 'navAdmin.php';
                        echo '<header id="F-header"  style="text-align: center;"><b>TIE BREAKER</b></header><br>';
                        echo '<main>';
                        echo '<form id = "main-form" method="POST" action = "Admin_vtReceipt" class="vtBallot" id="vtBallot"><div id="voting-page">';

                        if($_SESSION['admin_position']=="Head Admin")
                        {
                          $count_query = "SELECT * FROM student";
                          $count_res = mysqli_query($conn, $count_query);
                          $total = mysqli_num_rows($count_res);
                          
                          $QoutaAll = floor($total/2)+1; //this is the Quota for all candidate except the representatives
                          
                           $val = $conn->query('SELECT 1 from temp_candidate LIMIT 1');

                                  if($val !== FALSE)
                                  {
                                      $sql2 = "DROP TABLE temp_candidate";
                                      $conn->query($sql2);
                                  }
                                  else
                                  {
                                    //do nothing
                                  }
                                  
                           $samp = "SELECT position_id, COUNT(position_id), total_votes, COUNT(total_votes) FROM candidate GROUP BY position_id, total_votes HAVING COUNT(position_id)>1 AND COUNT(total_votes)>1";
                                $display_res = $conn->query($samp);
                                 if($display_res->num_rows>0){
                                     while($row = $display_res->fetch_assoc())
                               {
                            //echo $row['total_votes']." position id :".$row['position_id']."<br>";
                                 $samp2 = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) where candidate.position_id = ".$row['position_id']." AND total_votes = ".$row['total_votes']." ORDER BY candidate_position.heirarchy_id";

                                      $sql = "CREATE TABLE `temp_candidate` (
                                      `candidate_id` int(11) NOT NULL,
                                      `student_id` int(11) NOT NULL,
                                      `position_id` int(11) NOT NULL,
                                      `total_votes` int(11) NOT NULL,
                                      `party_name` varchar(30) NOT NULL,
                                      `platform_info` varchar(100) NOT NULL,
                                      `credentials` varchar(500) NOT NULL,
                                      `photo` varchar(30) NOT NULL
                                    )";
                                     $conn->query($sql);



                                 $display_res2 = $conn->query($samp2);
                                   while($row1 = $display_res2->fetch_assoc()){

                                    if($row1['vote_allow']==1){//for non-representative
                                      if($row1['total_votes']>=$QoutaAll)
                                      {
                                       $insert_data = 'INSERT INTO temp_candidate (candidate_id, student_id, position_id, total_votes, party_name, platform_info, credentials, photo) VALUES ("'.$row1['candidate_id'].'","'.$row1['student_id'].'","'.$row1['position_id'].'","'.$row1['total_votes'].'","'.$row1['party_name'].'","'.$row1['platform_info'].'","'.$row1['credentials'].'","'.$row1['photo'].'")';

                                       $conn->query($insert_data);
                                      }

                                    }
                                    else{//for representative
                                       $count_query1 = "SELECT * FROM student where grade_level = ".$row1['grade_level']."";
                                       $count_res1 = mysqli_query($conn, $count_query1);
                                       $total1 = mysqli_num_rows($count_res1);
                          
                                      $QoutaAll1 = floor($total1/2)+1;
                                     

                                      if($row1['total_votes']>=$QoutaAll1)
                                      {
                                         $insert_data1 = 'INSERT INTO temp_candidate (candidate_id, student_id, position_id, total_votes, party_name, platform_info, credentials, photo) VALUES ("'.$row1['candidate_id'].'","'.$row1['student_id'].'","'.$row1['position_id'].'","'.$row1['total_votes'].'","'.$row1['party_name'].'","'.$row1['platform_info'].'","'.$row1['credentials'].'","'.$row1['photo'].'")';

                                         $conn->query($insert_data1);
                                      }



                                      
                                   }
                                    
                              }
                            }
                          }
                        $table = $conn->query("SELECT * FROM ((temp_candidate INNER JOIN student ON temp_candidate.student_id = student.student_id) INNER JOIN candidate_position ON temp_candidate.position_id = candidate_position.position_id) ORDER BY candidate_position.heirarchy_id"); 

                        generateBallot($table);
                        require 'Admin_vtConfirm.php';
                        echo '</div>';
                        echo '<div id="vote-button"><button id="vote-btn" name = "vote-button" class="vote-btn" type = "button">SUBMIT</button></div>
                        </form>';
                        echo '</main>';
                        echo '<br>
                        <script src = "../js/modals.js"></script>';
                      }
                    
                  }else{
                      //post something here like election not yet over
                  }
             
    ?>
 </body>

</html>