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
                $student_id = mysqli_real_escape_string($connect, $data[0]);

                $fname = mysqli_real_escape_string($connect, $data[1]);

                $Mname = mysqli_real_escape_string($connect, $data[2]);

                $lname = mysqli_real_escape_string($connect, $data[3]);

                $gender = mysqli_real_escape_string($connect, $data[4]);

                $bumail = mysqli_real_escape_string($connect, $data[5]);

                $grade_level = mysqli_real_escape_string($connect, $data[6]);

                $otp = mysqli_real_escape_string($connect, $data[7]);

                $voting_status = mysqli_real_escape_string($connect, $data[8]);

                $query = " UPDATE student SET fname = '$fname', Mname = '$Mname', gender = '$gender', bumail = '$bumail', grade_level = '$grade_level', otp = '$otp', voting_status = '$voting_status' WHERE student_id = '$student_id'";

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
