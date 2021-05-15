
<?php

        if(isset($_POST["prnt"])){
           $output='<table border="1">
		   <tr>
			   <th>Name</th>
			   <th>Pres</th>
			   <th>Vice</th>
			   <th>Sec</th>
			   <th>Treasurer</th>
			   <th>Audit</th>
			   <th>Grade 7 Representative</th>
			   <th>Grade 8 Representative</th>
			   <th>Grade 9 Representative</th>
			   <th>Grade 10 Representative</th>
			   <th>Grade 11 Representative</th>
			   <th>Grade 12 Representative</th>
		   </tr>';
		   		include "../db_conn.php";
		   		$db = $conn;
	                        // $db = mysqli_connect('localhost', 'root', '', 'bucielsmain2');
	                        //get the all votes of each student (discard abstain)
	                        $sqlget = "SELECT vote.student_id, vote.status, vote.candidate_id, student.fname FROM vote INNER JOIN student ON vote.student_id = student.student_id WHERE vote.status = 'Voted'";  
	                        $query = mysqli_query($db,$sqlget);
				if (mysqli_num_rows($query) != null){
	                        $name = "";
	                        $pos = array_fill(0,11,0);
	                        $flname = array_fill(0,11," ");
	                        $flag = 0;
 	                        while($rowx = mysqli_fetch_array($query)){
	    	                if($rowx['student_id']!=$name && $flag == 0){
		                    $output .= '<tr><td>'. md5($rowx['student_id']).'</td>';
		                    $flag = 1;
		                    $name=$rowx['student_id'];
		                    $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$rowx['candidate_id'];
		                    $query2 = mysqli_query($db,$sqlget2);
		                    $rowy = mysqli_fetch_array($query2);
		                    $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$rowy['student_id'];
		                    $query3 = mysqli_query($db,$sqlget3);
		                    $rowz = mysqli_fetch_array($query3);
		                    $sqlget4 = "SELECT heirarchy_id FROM candidate_position WHERE position_id = ".$rowy['position_id'];
		                    $query4 = mysqli_query($db,$sqlget4);
		                    $rowt = mysqli_fetch_array($query4);
		                    $ho = $rowt['heirarchy_id']-1;
		                    $pos[$ho] = 1;
		                    $flname[$ho] = $rowz['fname']." ".$rowz['lname'];
		                    }
		
		                    else if($rowx['student_id']!=$name && $flag == 1){
			                    for($x = 0; $x < 11; $x++){	
				                    if($pos[$x]==1){
                                    $output .= '<td>'.$flname[$x].'</td>';
			                         }
			                        else{
                                    $output .= '<td> Abstained</td>';
			                         }
                            }
							$output .= '</tr><tr>';
		                    $name=$rowx['student_id'];
                            $output .= '<td>'.md5($rowx['student_id']).'</td>';
			                unset($pos);
			                unset ($flname);
			                $pos = array_fill(0,11,0);
			                $flname = array_fill(0,11," ");
			                $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$rowx['candidate_id'];
                            $query2 = mysqli_query($db,$sqlget2);
                            $rowy = mysqli_fetch_array($query2);
                            $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$rowy['student_id'];
                            $query3 = mysqli_query($db,$sqlget3);
                            $rowz = mysqli_fetch_array($query3);
                            $sqlget4 = "SELECT heirarchy_id FROM candidate_position WHERE position_id = ".$rowy['position_id'];
		                    $query4 = mysqli_query($db,$sqlget4);
		                    $rowt = mysqli_fetch_array($query4);
		                    $ho = $rowt['heirarchy_id']-1;
                            $pos[$ho] = 1;
                            $flname[$ho] = $rowz['fname']." ".$rowz['lname'];
                        }

                            else if ($rowx['student_id'] == $name){
                            $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$rowx['candidate_id'];
                            $query2 = mysqli_query($db,$sqlget2);
                            $rowy = mysqli_fetch_array($query2);
                            $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$rowy['student_id'];
                            $query3 = mysqli_query($db,$sqlget3);
                            $rowz = mysqli_fetch_array($query3);
                            $sqlget4 = "SELECT heirarchy_id FROM candidate_position WHERE position_id = ".$rowy['position_id'];
		                    $query4 = mysqli_query($db,$sqlget4);
		                    $rowt = mysqli_fetch_array($query4);
		                    $ho = $rowt['heirarchy_id']-1;
                            $pos[$ho] = 1;
                            $flname[$ho] = $rowz['fname']." ".$rowz['lname'];
                        }
                        
                    }
                    
                            for($x = 0; $x < 11; $x++){	
                                if($pos[$x]==1){
		                       $output .= '<td>'.$flname[$x].'</td>';
		                       }
		                       else{
                                
                                $output .= '<td>Abstained</td>';
		                       }
                            }
                            $output .= '</tr>';
							
							echo $output;
                            header("Content-type: application/xls");
                            header("Content-Disposition: attachment; filename=Summary of Votes.xls");
					
			//For Logs
			$_SESSION['action'] = 'printed Vote Summary.';
			include '../backAdmin/backFun_actLogs_v0_1.php';
                           
                        }
	}
						?>
					
                        </tr>
						</table>
                          
