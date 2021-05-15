<?php
	require 'front_Report_v11_1.php';

	$table = $conn->query("SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) ORDER BY candidate_position.heirarchy_id"); // get positions
	
	$choice_final = array();
	$vote_table = array();

	// Sanitation and Validation
	mysqli_data_seek($table, 0);
	//$stud_id = $_SESSION['student_id'];
	$status = "";
	while($poss = $table->fetch_assoc()){   // loop through all positions
		if(($poss["vote_allow"] == 0 && $_SESSION['admin_position'] == "Head Admin") || $poss["vote_allow"] == 1){
			if(empty(($_POST[$poss['heirarchy_id']]))){
				$choice = 0;
			}
			else{
				$_POST[$poss['heirarchy_id']] = filter_var($_POST[$poss['heirarchy_id']], FILTER_SANITIZE_STRING);;
				// $choice = $_POST[$poss['heirarchy_id']];
				$choice = cleanInput($_POST[$poss['heirarchy_id']]);
			}

			//if(isValidCandidate($conn, $choice, $poss['heirarchy_id'])){
				if($poss['candidate_id'] == $choice){
					$choice_final[$poss['heirarchy_id']] = $poss['candidate_id'];
					$status = "Voted";
				}
				else{
					$status = "Abstain";
				}
			//}
			/*else{
				// notify admin & return to ballot
				// echo "Ballot tampering detected.";
				errorMessage("Ballot tampering detected. You have been banned from voting and reported to the admins.");
				// Submit records marked invalid
				mysqli_data_seek($table, 0);
				while($poss = $table->fetch_assoc()){
					$cand_id = $conn->real_escape_string($poss['candidate_id']);
					$stud_id = $conn->real_escape_string($stud_id);
					$conn->query("INSERT INTO `vote` (`vote_log_id`, `student_id`, `candidate_id`, `status`, `time_stamp`) VALUES (NULL, $stud_id, $cand_id, 'Invalid', current_timestamp())");
				}
				// update voter's status
				//$conn->query("UPDATE `student` SET `voting_status` = true WHERE `student`.`student_id` = '$stud_id'");
				// notify admin
				notifyAdmin("Warning: An attempt to submit a tampered ballot was made! The user was automatically banned from voting.");
				exit();
				// header("Location: index.php");
			}*/
		}
		else{
			$status = " Abstain";
		}
		$vote_table[$poss['candidate_id']] = $status;
	}

	foreach($choice_final as $value){
		$candidate = $conn->real_escape_string($value);
		$conn->query("UPDATE candidate SET total_votes = total_votes + 1 WHERE candidate.candidate_id = $candidate");

// 		minus($sub);
// 		winString($sub, $candidate);

// 		$tiedStatus--;
// 		$winnerList = $winnerList." || candidate_id = ".$candidate."";	

	}

	// Submission
	// mysqli_data_seek($table, 0);
	// while($poss = $table->fetch_assoc()){
	// 	// echo $poss['heirarchy_id'];
	// 	if(($poss["vote_allow"] == 0 && $_SESSION['grade_level'] == $poss["grade_level"]) || $poss["vote_allow"] == 1){
	// 		$choice = $choice_final[$poss['heirarchy_id']];
	// 		if($poss['candidate_id'] == $choice){
	// 			$candidate = $conn->real_escape_string($poss['candidate_id']);
	// 			// $candidate = $poss['candidate_id'];
	// 			$conn->query("UPDATE candidate SET total_votes = total_votes + 1 WHERE candidate.candidate_id = $candidate");	
	// 		}
	// 	}
	// }
	
	mysqli_data_seek($table, 0);
	while($poss = $table->fetch_assoc()){
		$status = $conn->real_escape_string($vote_table[$poss['candidate_id']]);
		$cand_id = $conn->real_escape_string($poss['candidate_id']);
		//$stud_id = $conn->real_escape_string($stud_id);
		//$conn->query("INSERT INTO `vote` (`vote_log_id`, `student_id`, `candidate_id`, `status`, `time_stamp`) VALUES (NULL, $stud_id, $cand_id, '$status', current_timestamp())");
	}

	$sql2 = "DROP TABLE temp_candidate";
    $conn->query($sql2);
	

	// update voter's status
	// $conn->query("UPDATE `student` SET `voting_status` = true WHERE `student`.`student_id` = '$stud_id'");
?>
