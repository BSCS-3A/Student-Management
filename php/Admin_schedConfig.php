<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/BUHS LOGO.png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style2_actLogs.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/electionConfig.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap_addAdmin.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap_addAdmin.css">
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <script src="../js/jquery-1.11.1.min_addAdmin.js"></script>
    <script src="../js/jquery.dataTables.min_addAdmin.js"></script>
    <script src="../js/dataTables.bootstrap_addAdmin.js" ></script>
    <script src="../js/bootstrap.min_addADmin.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <!-- <script src="../js/electionConfig.js"></script> -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <title>Election Schedule Configuration  | BUCEILS HS Online Voting System </title>
</head>

<body>

    <!-- Navigation Bar -->
    <?php include "navAdmin.php"; ?>


    <div class="Dheader" id="Dheader">
       <h3 class="Dheader-txt">Time Scheduler</h3>
    </div>
    <form class="isog" method="POST" action="./backAdmin/backFun_setcountdown_v0_1.php">
    <div class="leftdiv">
       <br>
        <div>
            <label for="date">Date Start:</label>

        <input type="date" id="date" name="date" value="yyyy-mm-dd" placeholder="" required></input>
        </div>
        <br>

        <div>
            <label for="tstart">Time Starts:</label>
            <input type="time" id="tstart" name="tstart" placeholder="" required></input>
        </div>
        <br>
        <div>
            <label for="date">Date Ends:</label>

        <input type="date" id="date" name="dateEnd" value="yyyy-mm-dd" placeholder="" required></input>
        </div>
        <br>
        <div>
            <label for="tends">Time Ends:</label>
            <input type="time" id="tends" name="tends" placeholder="" required></input>
        </div>
        <br>
        <div>
           <!-- <script type="text/javascript" src="../assets/js/awaw.js"></script>onclick="passvalues();"-->
            <!--<button class="btn" type="submit" id="btnsave" name="savesched" >SAVE</button>--><!-- onclick="myFunction('date','tstart','tends')-->
            <button class="btn" type="submit" name="editsched" >UPDATE SCHEDULE</button>
        </div>
    </div>

</form>

<form method="post" action="./backAdmin/backFun_schedConfig_v0_1.php" >
		<div class="input-group">
			<label>Vote Reminders:</label>
            <textarea rows="15" cols="68" name="message" placeholder="" required></textarea>
		</div>
		<div class="input-group">
			<button class="btn" type="submit" name="save" >SEND REMINDERS</button>
		</div>
	</form>


    <!-- <div class="footer">
        <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
    </div> -->

    <script>
        $('.icon').click(function () {
            $('span').toggleClass("cancel");
        });
    </script>
	</div>

    
    <?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

</body>

</html>
<?php
}else{
    header("Location: AdminLogin.php");
     exit();
}
 ?>