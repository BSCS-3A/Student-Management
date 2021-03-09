<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "seproject";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die ('Unable to connect');

if(isset($_POST["import"])){
    $fileName = $_FILES['file']['tmp_name'];

    if($_FILES["file"]["size"] > 0){
        $file = fopen($fileName, "r");
        
        //Adjust na lang sa data na gusto ng customer
        while(($column = fgetcsv($file, 1000, ",")) !== FALSE){
            $sql_insert = "INSERT into stud_info (student_id, first_name, last_name, gender, email) values 
            ('" . $column[0] . "', 
             '" . $column[1] . "', 
             '" . $column[2] . "',
             '" . $column[3] . "', 
             '" . $column[4] . "')"; 

            $result = mysqli_query($conn, $sql_insert);

            if(!empty($result)){
                echo "CSV Data Imported into the database";
            }
            else{
                echo "Problem in importing csv";
            }
        }
    }
}
?>
