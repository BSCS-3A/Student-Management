<?php

    // include_once 'connect.php';
    include_once '../db_conn.php';
    session_start();

    if(isset($_POST['delete'])){
        $candidateid = $_POST['candidateid'];
        $sqlfind = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id) WHERE `candidate_id` = '$candidateid'";
        $resultfind = mysqli_query($conn,$sqlfind);
        $rowfind = mysqli_fetch_assoc($resultfind);

        $sql = "DELETE FROM `candidate` WHERE candidate_id = '$candidateid'";
        $result = mysqli_query($conn,$sql);
        if($result){
            $candidatename = $rowfind['fname'];
            $candidateposition = $rowfind['position_name'];
            if(!empty($rowfind['photo'])){//if has photo delete photo in directory    
                $path ="../".$rowfind['photo'];
                unlink($path);
            }
            $admin_id = $_SESSION['admin_id'];
            date_default_timezone_set('Asia/Manila');
            $time = date('H:i:s');
            mysqli_query($conn, "INSERT INTO admin_activity_log(activity_log_id,admin_id,activity_description,activity_date,activity_time) VALUES(NULL,$admin_id,'Deleted candidate:$candidatename from position: $candidateposition',CURRENT_TIMESTAMP,'$time')");
        }else{
            echo "Cannot delete(Query Error)";
        }
    }

    
        
    
     
    
?>