<!-- ELECTION ARCHIVES FOLDERS (ADMIN) -->
<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
        $year = $_GET['year'];
        //echo $year;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_monitor.css">
    <!-- <script src="assets/js/a076d05399.js"></script> -->
    <script src="../js/dataTables.bootstrap4.min_monitor.js"></script>
    <script src="../js/jquery-3.5.1_monitor.js"></script>
    <script src="../js/jquery.dataTables.min_monitor.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <!-- <script src="../js/countdown.js"></script> -->
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
    <title>Election Archive  | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php include 'navAdmin.php'; ?>

    <div class="ADheader" id="ADheader">
        <h2 class="aHeader-txt">ARCHIVES</h2>
    </div>
    
    <div class="Barch_year">
        <p><b><?php echo $year ?> ELECTION</b></p>
    </div>

    <div class="Barch_container">
    <?php

    require "db_conn.php";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    $schoolYear = mysqli_query($conn, "SELECT YEAR(school_year) AS schyear FROM archive");
    $archive = mysqli_query($conn, "SELECT * FROM archive ORDER BY archive_id");


    

    while (($shyear = mysqli_fetch_array($schoolYear)) && ($archRow = mysqli_fetch_array($archive))) {
        if ($year === $shyear['schyear']) {
            //echo $year;
            //require('ArchWinnerInfo.php');
            // echo '<div class="Bpstn">';
            // echo '<img src="../img/dp/1.jpg" />';
            // echo '<p class="Bname">'.$archRow['winner_fname'].' '.$archRow['winner_mname'].' '.$archRow['winner_lname'].'</p>';
            // echo '<p class="Bpstn">'.$archRow['position_name'].'</p>';
            // echo '</div>';

            echo '<div class="Bpstn">';
            if(!(empty($archRow['winner_mname']))){
                echo '<p class="Bname">'.$archRow['winner_fname'].' '.$archRow['winner_mname'][0].'. '.$archRow['winner_lname'].'</p>';
            } else {
                echo '<p class="Bname">'.$archRow['winner_fname'].' '.$archRow['winner_lname'].'</p>';
            }
            echo '<p class="Bpstn">'.$archRow['position_name'].'</p>';
            echo '<p class="Bplat1"> PLATFORMS </p>';
            echo '<p class="Bplat2">' .$archRow['platform_info']. '</p>';
            echo '</div>';
        }
    }
    
    ?>

    </div> 
    <br><br><br>

    <!-- <div class="footer">
        <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
    </div> -->

    <script>
        $('.icon').click(function() {
            $('span').toggleClass("cancel");
        });
    </script>
</body>

</html>
<?php
}else{
    header("Location: AdminLogin.php");
     exit();
}
 ?>