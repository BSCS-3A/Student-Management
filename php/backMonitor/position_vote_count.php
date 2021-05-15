<?php
    // require 'db_connection.php';   
    require 'db_conn.php';
    
    $query = 
    "SELECT 
      cp.heirarchy_id as heirarchy_order, 
      c.position_id as position, 
      sum(c.total_votes) as votes_per_position
      FROM candidate_position cp
      LEFT JOIN candidate c
      ON c.position_id=cp.position_id
      GROUP BY heirarchy_order 
      ORDER BY heirarchy_order";

    $result = mysqli_query($conn, $query);
    
    $position_votes = array();
	  while($vote=mysqli_fetch_array($result)){
      $position_votes[] = array(
        "heirarchy_order"=>$vote['heirarchy_order'],
        "position"=>$vote['position'],
        "votes_per_position"=>$vote['votes_per_position']
      );
    }
?>
