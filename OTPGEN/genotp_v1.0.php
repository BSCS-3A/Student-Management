<html>
<head><title>test site2</title></head>
<body>
<?php
    $servername = "localhost";
    $username = "id16226795_applesauce";
    $password = "LhdOOtCN0<x_-r(W";
    $dbname = "id16226795_studinfo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else{
    echo "Connection Established";
    }
    $generator = "1234567890";
    $result = "";
    $sql = "SELECT * FROM `studinfo`";
    $ss = $conn->query($sql);
    echo " " .$ss->num_rows ." rows";

    while($row = $ss->fetch_assoc()){
            $hold = $row["Pkey"];
            for ($i = 1; $i <= 6; $i++){
                $result .= substr($generator, (rand()%(strlen($generator))), 1);
            }
                $xql = "UPDATE `studinfo` SET `otp` = $result WHERE `Pkey` = $hold ";
                $conn->query($xql);
                $result = "";
    }

?>
</body>
</html>