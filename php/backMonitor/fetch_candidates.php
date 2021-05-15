<?php
	// require 'db_connection.php';
	require "db_conn.php";

	$query = 
		"SELECT 
			cp.position_name as position,
			cp.heirarchy_id as heirarchy_order,
			s.fname as first_name,
			s.Mname as middle_name,
			s.lname as last_name,
			c.candidate_id,
			c.student_id,
			c.position_id,
			c.total_votes,
			c.party_name,
			c.photo
		FROM
			candidate c
		LEFT JOIN
			candidate_position cp ON c.position_id = cp.position_id
		LEFT JOIN
			student s ON c.student_id = s.student_id
		ORDER BY
			heirarchy_order";

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch Data
	// $candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$candidates = array();
	while($candidate=mysqli_fetch_array($result)){
		$candidates[] = array(
			"photo"=>$candidate['photo'],	
			"first_name"=>strtoupper($candidate['first_name']),
			"middle_name"=>strtoupper($candidate['middle_name']),
			"last_name"=>strtoupper($candidate['last_name']),
			"total_votes"=>$candidate['total_votes'],
			"position"=>$candidate['position'],
			"party_name"=>$candidate['party_name']
        	);
	}
?>
