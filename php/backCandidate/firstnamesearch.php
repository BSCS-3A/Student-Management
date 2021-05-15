<?php
    include_once '../db_conn.php';


    if(isset($_POST['query'])){
        $firstname = $_POST['query'];
        $sql = "SELECT * FROM `student` WHERE `fname` LIKE '%".$firstname."%'";
        $result = mysqli_query($conn,$sql);
        $margin = 0;
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a id='f' class = 'list-group-item list-group-action-border-1' style='z-index:200;margin-top:".$margin."px;'>".$row['fname']."_".$row['lname']."</a>";
                $margin = $margin+35;
            }
            $margin = 0;
        }else{
            echo "<a id='noresults' class = 'list-group-item list-group-action-border-1' style='z-index:200;margin-top:".$margin."px;'>no results found..</a>";
        }
        
    }   




?>