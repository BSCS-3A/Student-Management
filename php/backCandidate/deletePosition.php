<?php
    session_start();
    // include_once 'connect.php';
    include_once '../db_conn.php';

    function decrement($conn,$query){
        $result = mysqli_query($conn,$query); 
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($array, $row['position_id']); 
        }

        $sqlfe ="";
        foreach($array as $posid){

            $sqlfe .=  "UPDATE `candidate_position` SET `heirarchy_id` = `heirarchy_id`-1 WHERE `position_id` = '$posid'".";";
            
        }

        mysqli_multi_query($conn,$sqlfe); 
    }
    
    if(isset($_POST['delete'])){
        $positionId = mysqli_real_escape_string($conn,trim($_POST['delete']));
        $geth = "SELECT `heirarchy_id`,`position_name` FROM `candidate_position` WHERE `position_id`= '$positionId' ";
        $gethresult = mysqli_query($conn,$geth);

        $sql = "DELETE FROM `candidate_position` WHERE `candidate_position`.`position_id` = '$positionId'";
        $result = mysqli_query($conn,$sql);
        if($result){//if query result add a log to access logs
            $rowgeth = mysqli_fetch_assoc($gethresult);
            if(mysqli_num_rows($gethresult)==1){    
                $temp = $rowgeth['heirarchy_id'];
                $positionName = $rowgeth['position_name'];
                $query = "SELECT * FROM `candidate_position` WHERE `heirarchy_id` >= '$temp'";
                decrement($conn,$query);
                $admin_id = $_SESSION['admin_id'];
                date_default_timezone_set('Asia/Manila');
                $time = date('H:i:s');
                mysqli_query($conn, "INSERT INTO admin_activity_log(activity_log_id,admin_id,activity_description,activity_date,activity_time) VALUES(NULL,$admin_id,'Deleted position:$positionName',CURRENT_TIMESTAMP,'$time')");//position name variable
            }else{
                echo "No hierarchy_id found";
            }
        }else{
            echo "query failed";
        }
    }
?>