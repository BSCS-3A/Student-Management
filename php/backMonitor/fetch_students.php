<?php
	// require 'db_connection.php';
	require '../db_conn.php';
	$samp = $_GET['level'];
	$query = "SELECT lname, fname, Mname, voting_status FROM student WHERE grade_level = '".$samp."'";

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch Data
	//$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$students = array();
	while($student=mysqli_fetch_array($result)){
		if($student['voting_status']==1){
			$status = 'VOTED';
		}else{
			$status = '<font color=red>NOT YET VOTED</font>';
		}
		$students[] = array( 
		"lname"=>$student['lname'],
		"fname"=>$student['fname'],
		"Mname"=>$student['Mname'],
		"voting_status"=>$status,
   );
	}

	echo json_encode($students);
?>