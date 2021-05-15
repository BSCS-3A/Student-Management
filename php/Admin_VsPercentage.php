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
    <link rel="stylesheet" href="../css/admin_css/style_monitor.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_monitor.css">
    <script src="../js/jquery.dataTables.min_monitor.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
    <title>Election Vote Status  | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php include 'navAdmin.php'; ?>
   
    <div class="ADheader" id="ADheader">
        <h2 class="aHeader-txt">VOTE STATUS</h2>
    </div>
    
    <?php
    //====================variables==================
    $gr7 = 0;
    $gr7_voted = 0;
    $gr7_percent = 0;
    $gr8 = 0;
    $gr8_voted = 0;
    $gr8_percent = 0;
    $gr9 = 0;
    $gr9_voted = 0;
    $gr9_percent = 0;
    $gr10 = 0;
    $gr10_voted = 0;
    $gr10_percent = 0;
    $gr11 = 0;
    $gr11_voted = 0;
    $gr11_percent = 0;
    $gr12 = 0;
    $gr12_voted = 0;
    $gr12_percent = 0;

    /*Database query for retrieving data of student and their status*/

    //============================for gr 7 ==========================
    $gr_7 = "SELECT * FROM student where grade_level = 7";
    if ($result = mysqli_query($conn, $gr_7)) {
        $gr7 = mysqli_num_rows($result);
        $gr_7a = "SELECT * FROM student where grade_level = 7 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_7a)) {
            $gr7_voted = mysqli_num_rows($result1);
        }
    }

    
    if($gr7!=0){
        $gr7_percent = ($gr7_voted / $gr7) * 100;
    } else {
        $gr7_percent = ($gr7_voted / 1) * 100;
    }

    //=========================for grade 8============================

    $gr_8 = "SELECT * FROM student where grade_level = 8";
    if ($result = mysqli_query($conn, $gr_8)) {
        $gr8 = mysqli_num_rows($result);
        $gr_8a = "SELECT * FROM student where grade_level = 8 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_8a)) {
            $gr8_voted = mysqli_num_rows($result1);
        }
    }

    if($gr8!=0){
        $gr8_percent = ($gr8_voted / $gr8) * 100;
    } else {
        $gr8_percent = ($gr8_voted / 1) * 100;
    }

    //========================for grade 9 ==============================
    $gr_9 = "SELECT * FROM student where grade_level = 9";
    if ($result = mysqli_query($conn, $gr_9)) {
        $gr9 = mysqli_num_rows($result);
        $gr_9a = "SELECT * FROM student where grade_level = 9 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_9a)) {
            $gr9_voted = mysqli_num_rows($result1);
        }
    }

    if($gr9!=0){
        $gr9_percent = ($gr9_voted / $gr9) * 100;
    } else {
        $gr9_percent = ($gr9_voted / 1) * 100;
    }

    //============================for grade 10 ==========================

    $gr_10 = "SELECT * FROM student where grade_level = 10";
    if ($result = mysqli_query($conn, $gr_10)) {
        $gr10 = mysqli_num_rows($result);
        $gr_10a = "SELECT * FROM student where grade_level = 10 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_10a)) {
            $gr10_voted = mysqli_num_rows($result1);
        }
    }

    if($gr10!=0){
        $gr10_percent = ($gr10_voted / $gr10) * 100;
    } else {
        $gr10_percent = ($gr10_voted / 1) * 100;
    }
    //========================for grade 11 ===============================
    $gr_11 = "SELECT * FROM student where grade_level = 11";
    if ($result = mysqli_query($conn, $gr_11)) {
        $gr11 = mysqli_num_rows($result);
        $gr_11a = "SELECT * FROM student where grade_level = 11 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_11a)) {
            $gr11_voted = mysqli_num_rows($result1);
        }
    }

    if($gr11!=0){
        $gr11_percent = ($gr11_voted / $gr11) * 100;
    } else {
        $gr11_percent = ($gr11_voted / 1) * 100;
    }

    //========================for grade 12 ================================
    $gr_12 = "SELECT * FROM student where grade_level = 12";
    if ($result = mysqli_query($conn, $gr_12)) {
        $gr12 = mysqli_num_rows($result);
        $gr_12a = "SELECT * FROM student where grade_level = 12 and voting_status = 1";
        if ($result1 = mysqli_query($conn, $gr_12a)) {
            $gr12_voted = mysqli_num_rows($result1);
        }
    }

    if($gr12!=0){
        $gr12_percent = ($gr12_voted / $gr12) * 100;
    } else {
        $gr12_percent = ($gr12_voted / 1) * 100;
    }

    //===================== ======end============================================
    ?>

    <div class="Bcon">
        <div class="Bvcontainer">
            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false" > <?php //ang gr7_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na ?>
                       <div class="circle" data-percent=<?php echo '' . $gr7_percent . ''; ?>>
                            <div></div>
                        </div>
                       
                    </div>

                     <br><a href='Admin_Vstat.php?level=7'><b> GRADE 7</b></a>
                </div>
            </div>

            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false"><?php //ang gr8_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na
                                                                    ?>
                        <div class="circle" data-percent=<?php echo '' . $gr8_percent . ''; ?>>
                            <div></div>

                        </div>
                    </div>
                     <br><a href='Admin_Vstat.php?level=8'><b> GRADE 8</b></a>
                </div>
            </div>

            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false"><?php //ang gr9_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na
                                                                    ?>
                        <div class="circle" data-percent=<?php echo '' . $gr9_percent . ''; ?>>
                            <div></div>

                        </div>
                    </div>
                     <br><a href='Admin_Vstat.php?level=9'><b> GRADE 9</b></a>

                </div>
            </div>

            
            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false"><?php //ang gr10_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na
                                                                    ?>
                        <div class="circle" data-percent=<?php echo '' . $gr10_percent . ''; ?>>
                            <div></div>

                        </div>
                    </div>
                     <br><a href='Admin_Vstat.php?level=10'><b> GRADE 10</b></a>

                </div>
            </div>

            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false"><?php //ang gr11_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na
                                                                    ?>
                        <div class="circle" data-percent=<?php echo '' . $gr11_percent . ''; ?>>
                            <div></div>

                        </div>
                    </div>
                     <br><a href='Admin_Vstat.php?level=11'><b> GRADE 11</b></a>

                </div>
            </div>

            <div class="Bcard">
                <div class="Bbox">
                    <div class="progressbar" data-animate="false"><?php //ang gr12_percent sya yung gagamitin para sa bar, yung naga pakita kung ilang percent na
                                                                    ?>
                        <div class="circle" data-percent=<?php echo '' . $gr12_percent . ''; ?>>
                            <div></div>

                        </div>
                    </div>
                     <br><a href='Admin_Vstat.php?level=12'><b> GRADE 12</b></a>

                </div>
            </div>

            <?php
            //additional notes:
            // yung mga ganito =  <br><a href='Admin_Vstat.php?level=12'><b> GRADE 12</b></a>
            //sya yung sa label baga na pag tig click maga redirect
            ?>


        </div>
    </div>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js'></script>
    <script src="../js/script_monitor.js?v=<?php echo time(); ?>"></script>

</body>

</html>
<?php
}else{
    header("Location: AdminLogin.php");
     exit();
}
 ?>