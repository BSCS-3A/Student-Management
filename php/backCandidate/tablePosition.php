<?php
	include_once '../db_conn.php';
    session_start();

	$sql = "SELECT * FROM `candidate_position` ORDER BY heirarchy_id";
    $result = mysqli_query($conn,$sql);
    $numrows = mysqli_num_rows($result);
    
    if($numrows > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr posid='".$row['position_id']."'><td>".$row['heirarchy_id']."</td><td>".$row['position_name']."</td><td>".$row['position_description']."</td> <td style='white-space: nowrap;'> <button class='btn btn-primary btn-xs' data-title='Edit' data-target='#edit' data-placement='top' data-toggle='modal' title='Edit' onclick='positionDisplay(this)'><span class='fa fa-edit'></span> EDIT</button>
                <button class='btn btn-danger btn-xs' data-title='Delete' data-target='#delete' data-placement='top' data-toggle=modal title='Delete' onclick='deleteRow(this)'><span class='fa fa-trash-alt'></span> DELETE</button> </td><td><label class= 'switch'>";
            if($row['vote_allow']==0){
                echo "<input class='vote_allow' type='checkbox'> <span class='slider round'></span></label></td></tr>";
            }
            else{
                echo "<input class='vote_allow' type='checkbox' checked> <span class='slider round'></span></label></td></tr>";
            }
        }
    }else{
        echo "<tr><td colspan='6' >no data inside position table.</td></tr>";
    }

?>
