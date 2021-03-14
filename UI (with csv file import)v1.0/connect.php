<?php

//palitan nalang pag magconnect sa hosting site
$dbServername = "localhost";
$dbUsername = "root";   //id1621880_webhostingbscs3a
$dbPassword = "";       //id16218880_buceils
$dbName = "seproject";

$connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die ('Unable to connect');
$message = "";

$query = "SELECT * FROM student";
$result = mysqli_query($connect, $query);

if(isset($_POST["upload"])){
    if($_FILES['info_file']['name']){
        $filename = explode(".", $_FILES['info_file']['name']);
        if(end($filename) == "csv"){
            $handle = fopen($_FILES['info_file']['tmp_name'], "r");
            while($data = fgetcsv($handle)){
                $id = mysqli_real_escape_string($connect, $data[0]);

                $student_id = mysqli_real_escape_string($connect, $data[1]);

                $last_name = mysqli_real_escape_string($connect, $data[2]);

                $first_name = mysqli_real_escape_string($connect, $data[3]);

                $grade_section = mysqli_real_escape_string($connect, $data[4]);

                $email = mysqli_real_escape_string($connect, $data[5]);

                $query = " UPDATE student SET student_id = '$student_id', last_name = '$last_name', first_name = '$first_name', grade_section = '$grade_section', email = '$email' WHERE id = '$id'";

                mysqli_query($connect, $query);
            }
            fclose($handle);
            header("location: StudentAccountManagement.php>updation=1");
        }
        else{
            $message = '<label class="text-danger">Please Select CSV File</label>';
        }
    }
    else{
        $message = '<label class="text-danger">Please Select File</label>';
    }
}

if(isset($_GET["updation"])){
    $message = '<label class="text-success">File Updated</label>';
}


?>
