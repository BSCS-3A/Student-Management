<?php
    include_once '../db_conn.php';

    if(isset($_POST['query'])){
        $lastname = $_POST['query'];
        $sql = "SELECT * FROM `student` WHERE `lname` LIKE '%".$lastname."%' ORDER BY lname";
        $result = mysqli_query($conn,$sql);
        $margin = 0;
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a id='l' class = 'list-group-item list-group-action-border-1' style='z-index:200;'>".$row['lname']."_".$row['fname']."</a>";
                $margin= $margin +70;
            }
            $margin = 0;
        }else{
            echo "<a id='noresults' class = 'list-group-item list-group-action-border-1' style='z-index:200;'>no results found..</a>";
        }
    }    

?>