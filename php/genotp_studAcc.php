<?php
if(isset($_POST["go"])){

    // $dbServername = "localhost";
    // $dbUsername = "root";   //id1621880_webhostingbscs3a
    // $dbPassword = "";       //id16218880_buceils
    // //$dbName = "seproject";
    // $dbName = "bucielsmain2";  //local Den 4/9/21
    // $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    include "db_conn.php";

    $sql = "UPDATE `student` SET `otp` = '' ";
    $connect->query($sql);
    
    $generator = "568942371";
    $result = "";
    $sql = "SELECT * FROM `student`";
    $ss = $connect->query($sql);
    while($row = $ss->fetch_assoc()){
        do{
            $flag = 0;
            $hold = $row["student_id"];
            for ($i = 1; $i <= 6; $i++){ 
                $result .= substr($generator, (rand()%(strlen($generator))), 1);
            }
            $yql = "SELECT * FROM `student` WHERE `otp` = '$result' "; 
            $done = $connect->query($yql); 
            $see = $done->fetch_assoc(); 
            if(isset($see["otp"])== false){ 
                $xql = "UPDATE `student` SET `otp` = '$result' WHERE `student_id` = $hold ";
                $connect->query($xql);
                $result = "";
                $flag = 1;
            }
        }while($flag == 0);
    }
    
    //For Logs
    $_SESSION['action'] = "generated the students' OTP.";
    include 'backFun_actLogs_v0_1.php';
    
    header("location: Admin_studAcc.php");
}
?>
