<?php
    function showCandidate($poss){
        $imageLoc = $poss["photo"];
        if (!file_exists($imageLoc)) {
            $imageLoc = "../img/admin.png";
        }
        echo '<label class="checkbox">
            <input type="radio" required name="'.$poss["heirarchy_id"].'" id="vote" value="'.$poss["candidate_id"].'" onclick="document.getElementById(\''.$poss['heirarchy_id'].'\').innerHTML = \''.$poss['fname']." ".$poss['lname'].'\'">
                <span class="checkmark"></span>
                    <a><img src="'.$imageLoc.'" class="candidate-photo" style="float: left; width: 100px; height: 100px;" alt="Candidate" ></a>
                    
                  <div class="candidate-info">';
                  
        echo '<a id="F-CandidateName"><b> Name: ' .$poss["fname"]. " " . $poss["lname"]. '</b></a><br><a id="F-Partylist"> Party: ' .$poss["party_name"]. '</a><br><a id="F-Platform"> Platform: ' . $poss["platform_info"]. '</a>
        </div>
        </label>';

    }
    function showAbstain($poss){
        echo'<label class="checkbox"><input type="radio" required checked name="'.$poss["heirarchy_id"].'"  id="vote" value = "0" onclick="document.getElementById(\''.$poss["heirarchy_id"].'\').innerHTML = \'Abstain\'"><span class="checkmark"></span><b> Abstain </b></label></div>';
    }

    function generateBallot($table){
        $heir_id = 0;
        echo'    <div>';
        $counter = 0;
        mysqli_data_seek($table, 0);
        while($poss = $table->fetch_assoc()){   // loop through all positions
            if(($poss["vote_allow"] == 0 && $_SESSION['grade_level'] == $poss["grade_level"]) || $poss["vote_allow"] == 1){
                // position div
                if($heir_id != $poss["heirarchy_id"]){
                    $heir_id = $poss["heirarchy_id"];
                    if(($counter % 2) != 0){
                        echo'</div>';
                    }
                    $counter = 0;
                    echo'</div>';
                    echo'<div id="F-container">';
                    echo'<a id="F-position" style="float: left;">'.$poss["position_name"].'</a><hr>';
                    // candidate div
                    echo'<div>';
                    showAbstain($poss);         // display abstain choice
                    echo'<div class="candidate-box" ><div>';
                    showCandidate($poss);       // display candidate
                    echo'</div>';               // end of candidate div
                    $counter++;
                // end of position div 
                }
                else{
                    if(($counter % 2) != 0){
                        echo '<div>';
                        showCandidate($poss);   // display candidate
                        echo'</div>';
                        echo'</div>';           // end of candidate div
                        $counter++;
                    }
                    else{
                    echo '<div class="candidate-box" >';
                        echo'<div>';
                        showCandidate($poss);   // display candidate
                        echo'</div>';           // end of candidate div
                        $counter++;
                    }
        
                }
            }

        }
        echo'    </div>';
    }
?>