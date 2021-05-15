<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min">
      <link rel="stylesheet" type="text/css" href="../css/student_css/student_css/bootstrap_vote.css"> -->
      <!-- <link rel="stylesheet" type="text/css" href="../css/student_css/bootstrap.min_vote.css"> -->
      <!-- <link rel="stylesheet" type="text/css" href="../css/student_css/styles_vote.css"> -->
      <script src="../js/bootstrap_vote.js"></script>
      <script src="../js/bootstrap.min_vote.js"></script>
    </head>

  
  <body>
  
    <!-- Trigger/Open The Modal -->
    <!-- <button id="vote-button">Submit</button> -->

    <!-- The Modal -->
    <div id="confirmation" class="F-modal">
    <!-- Modal content -->
    <div class="F-modal-content">
        <div class="F-modal-header">
        <h2>VOTE PREVIEW</h2>
        </div>
        <div class="F-modal-body">
            <div class="F-show-votes">
                <p>Voter: <a href="#" id="VoterName"><?php echo $_SESSION['fname'].' '. $_SESSION['lname']?></a></p>
                <div class="display-votes">
                  <?php
                    mysqli_data_seek($table, 0);
                    $heir_id = 0;
                    echo'    <div>';
                    $counter = 0;
                    while($poss = $table->fetch_assoc()){   // loop through all positions
                        if(($poss["vote_allow"] == 0 && $_SESSION['grade_level'] == $poss["grade_level"]) || $poss["vote_allow"] == 1){
                            // position div
                            if($heir_id != $poss["heirarchy_id"]){
                                $heir_id = $poss["heirarchy_id"];
                                // echo position
                                echo 
                                '<tr id="display-vote-info">
                                  <td id="F-preview-Position">'.$poss["position_name"].':</td>
                                  <td id="F-preview-CandidateName"><span id = "'.$poss["heirarchy_id"].'">Abstain</span></td>
                                </tr>
                                <br>';
                            // end of position div 
                            }
                            $counter++;
                        }
                    }
                    echo'    </div>';
                  ?>
                </div>
            </div>
            <br>
            <p>Your votes are about to be submitted. Are you sure?</p>
        </div>
        <div class="F-modal-button">
            <button type="button" id="return-button" class="F-returnBTN"><span>Return to Voting</span></button>
            <button type="submit" name = "confirm-button" id="confirm-button" class="F-confirmBTN"><span>Confirm Submission</span></button>
        </div>
      </div>
    </div>
  </body>
</html>