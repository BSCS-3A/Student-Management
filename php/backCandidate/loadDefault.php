<?php
    // include 'connect.php';
    include "../db_conn.php";
    session_start();
   
    if(isset($_POST['btnclicked'])){
        $query = "SELECT * FROM `candidate`";
        $querysult = mysqli_query($conn,$query);
        if(mysqli_num_rows($querysult)==0){    
            $sql = "INSERT INTO `candidate_position` (`position_id`, `heirarchy_id`, `position_name`, `position_description`, `vote_allow`) VALUES
                (1, 1, 'President', 'The head of the Supreme Student Government.', 1),
                (2, 2, 'Vice President', 'Supports the President and will assume the presidency if the President resigns.', 1),
                (3, 3, 'Secretary', 'In charge of organization correspondence and document keeping.', 1),
                (4, 4, 'Treasurer', 'Financial officer in charge of book keeping organization expenses, income and savings.', 1),
                (5, 5, 'Auditor', 'Audits the financial records of the treasurer.', 1),
                (6, 6, 'Grade 7 Representative', 'Represents the voice of the Grade 7 students.', 0),
                (7, 7, 'Grade 8 Representative', 'Represents the voice of the Grade 8 students.', 0),
                (8, 8, 'Grade 9 Representative', 'Represents the voice of Grade 9 students.', 0),
                (9, 9, 'Grade 10 Representative', 'Represents the voice of the Grade 10 students.', 0),
                (10, 10, 'Grade 11 Representative', 'Represents the voice of the Grade 11 students.', 0),
                (11, 11, 'Grade 12 Representative', 'Represents the voice of the Grade 12 students.', 0);";

            $result = mysqli_query($conn,"DELETE FROM candidate_position");           
            $result = mysqli_query($conn,$sql);
            
            if($result){
                $admin_id = $_SESSION['admin_id'];
                date_default_timezone_set('Asia/Manila');
        		$time = date('H:i:s');
                mysqli_query($conn, "INSERT INTO admin_activity_log(activity_log_id,admin_id,activity_description,activity_date,activity_time) VALUES(NULL,$admin_id,'loaded default positions',CURRENT_TIMESTAMP,'$time')");
                echo "Default positions added";
            }else{
                
                echo "Query error";
            }
        }
        else{
            echo "Cannot load default positions (Delete candidates first)";
        }
    }

    
?>