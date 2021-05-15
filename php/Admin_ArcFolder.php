<!--ELECTION ARCHIVES FOLDERS (ADMIN)-->
<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/styles_folderMonitor.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_monitor.css">
    <script src="../js/dataTables.bootstrap4.min_monitor.js"></script>
    <script src="../js/jquery-3.5.1_monitor.js"></script>
    <script src="../js/jquery.dataTables.min_monitor.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
    <title>Election Archive  | BUCEILS HS Online Voting System</title>
</head>

<body>
    
    <?php include "navAdmin.php"; ?>

    <div class="ADheader" id="ADheader">
        <h2 class="aHeader-txt">ARCHIVES</h2>
    </div>

    <?php
    //  Election Archives Folders (Admin)
    require "db_conn.php";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    $result1 = mysqli_query($conn, "SELECT YEAR(start_date) AS year 
    FROM vote_event
    ORDER BY vote_event_id;"
    );

    while ($row1 = mysqli_fetch_array($result1)) {
        if (empty($row1['year'])) {
            echo "no content";
        } else {
            $year = $row1['year'];
            echo '<div class="items">';
            echo '<figure>';
            echo '<b><a href="Admin_ArcList.php?year='.$year.'">';
            echo '<img src="../img/folder.png" width="140px" height="140px">';
            echo '<figcaption>'.$year.'</figcaption>';
            echo '</a></b>';
            echo '</figure>';
            echo '</div>';
        }
    }
    ?>

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