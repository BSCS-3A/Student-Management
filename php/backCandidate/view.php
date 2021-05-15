<?php
    // include_once 'connect.php';
	include_once '../db_conn.php';
    session_start();
// <p class = "card_position">'.$row['position_name'].'</p> adds position to profile card

	if(isset($_POST['heirarchy_id'])){
	    $selected = $_POST['heirarchy_id'];
	    if($selected!=0){
	        $sql = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) WHERE candidate_position.heirarchy_id = '$selected'";
	        $result = mysqli_query($conn, $sql);
	        if(mysqli_num_rows($result) > 0){
		        while($row = mysqli_fetch_assoc($result)){
		            if(!empty($row['photo'])){	    
		    	        echo '<div class = "column">
			                    <div class = "card" id ="profile"> 
			    		            <div class="avatar">    
			    		                <img class="pic" src = "'.$row['photo'].'">
			    		            </div>
			    		        <h3 class = "card_name">'.$row['lname'].', '.$row['fname'].'</h3>
			    		        <p class = "card_partylist">'.$row['party_name'].'</p> 
			    		        <p class = "card_position">'.$row['position_name'].'</p>
			    		        <button credentials="'.$row['credentials'].'" platform="'.$row['platform_info'].'" id="modalbtn" class="btn btn-primary btn-xs" data-title="View" data-toggle="modal" data-target="#view" data-pacement="top" title="View"> View More</button>
			    		    </div>
			    	        </div>';
		            }else{
		                echo '<div class = "column">
		                <div id="hidden_id" style="display:none;">'.$row['candidate_id'].'</div>
			                    <div class = "card" id ="profile">
			    		            <div class="avatar">    
			    		                <img class="pic" src = "../img/admin.png">
			    		            </div>
			    		        <h3 class = "card_name">'.$row['lname'].', '.$row['fname'].'</h3>
			    		        <p class = "card_partylist">'.$row['party_name'].'</p>
			    		        <p class = "card_position">'.$row['position_name'].'</p>
			    		        <button credentials="'.$row['credentials'].'" platform="'.$row['platform_info'].'" id="modalbtn" class="btn btn-primary btn-xs" data-title="View" data-toggle="modal" data-target="#view" data-pacement="top" title="View"> View More</button>
			    		    </div>
			    	        </div>';
		            }
		        }
	        }

	    }else{
	        $sql = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) ORDER BY heirarchy_id";
	        $result = mysqli_query($conn, $sql);
	        if(mysqli_num_rows($result) > 0){
		        while($row = mysqli_fetch_assoc($result)){
		            if(!empty($row['photo'])){	    
		    	        echo '<div class = "column">
			                    <div class = "card" id ="profile">
			    		            <div class="avatar">    
			    		                <img class="pic" src = "'.$row['photo'].'">
			    		            </div>
			    		        <h3 class = "card_name">'.$row['lname'].', '.$row['fname'].'</h3>
			    		        <p class = "card_partylist">'.$row['party_name'].'</p>
			    		        <p class = "card_position">'.$row['position_name'].'</p>
			    		        <button credentials="'.$row['credentials'].'" platform="'.$row['platform_info'].'" id="modalbtn" class="btn btn-primary btn-xs" data-title="View" data-toggle="modal" data-target="#view" data-pacement="top" title="View"> View More</button>
			    		    </div>
			    	        </div>';
		            }else{
		                echo '<div class = "column">
		                <div id="hidden_id" style="display:none;">'.$row['candidate_id'].'</div>
			                    <div class = "card" id ="profile">
			    		            <div class="avatar">    
			    		                <img class="pic" src = "../img/admin.png">
			    		            </div>
			    		        <h3 class = "card_name">'.$row['lname'].', '.$row['fname'].'</h3>
			    		        <p class = "card_partylist">'.$row['party_name'].'</p>
			    		        <p class = "card_position">'.$row['position_name'].'</p>
			    		        <button credentials="'.$row['credentials'].'" platform="'.$row['platform_info'].'" id="modalbtn" class="btn btn-primary btn-xs" data-title="View" data-toggle="modal" data-target="#view" data-pacement="top" title="View"> View More</button>
			    		    </div>
			    	        </div>';
		            }
		        }
	        }
	    }
	}  


?>
