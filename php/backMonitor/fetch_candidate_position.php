<?php
    // require 'db_connection.php';
    require "db_conn.php";

    $query = "SELECT position_name FROM candidate_position ORDER BY heirarchy_id";

    $result = mysqli_query($conn, $query);

    // $candidate_positions = array();
    while($candidate_position=mysqli_fetch_assoc($result)){
		  $candidate_positions[] = $candidate_position;
	  }

    $size = sizeof($candidate_positions);
    
?>
