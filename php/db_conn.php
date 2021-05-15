<?php
    date_default_timezone_set('Asia/Manila');
    // $servername = "localhost";
    // $username = "id16218880_bscs";
    // $password = "J!\-~q!r]fZJf0EH";
    // $dbname = "id16218880_buceils";

    $servername = "localhost";
    $username = "root";
    $password = "";
    // $dbname = "id16218880_buceils"; // JP
    $dbname = "bucielsmain2";       // Den
    // $dbname = "check";     
    
    require_once 'Student_vtValSan.php';
    @$conn = new mysqli($servername,$username,$password,$dbname);
    if ($conn -> connect_errno) {
        // echo "Failed to connect to Database: " . $conn -> connect_error;
        errorMessage("There seems to be an error. <br> It's not you, it's us. We're trying our best to make this work. ");
        exit();
    }

    $connect  = $conn;
    $db = $conn;
    $connection = $conn;
    
// JP
    // $dbhost = "localhost";
    // $dbuser = "id16218880_webhostingbscs3a";
    // $dbpass = "t9%~bjqmK)uHAwe[";
    // $db = "id16218880_buceils";
    // $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
    
    // if ($conn->connect_error) {
    //     die("Connection to database failed: ". $conn->connect_error);
    // }
?>