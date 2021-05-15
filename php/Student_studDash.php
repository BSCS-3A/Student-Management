<?php
session_start();
include('db_conn.php');
 if (isset($_SESSION['student_id']) && isset($_SESSION['bumail'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" href="../css/student_css/bootstrap_studDash.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/style_studDash.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="../js/student_session_timer.js"></script>
    <!-- <script src="../js/bootstrap.min_Pos.js"></script> -->
    <!-- <script src="../js/countdown.js"></script> -->
    <title>Home | BUCEILS HS Online Voting System</title>
</head>

<body>
    <!--navbar-->
    <?php include "navStudent.php" ?>

    
    <!--Left Content-->
    <section>
        <article>
            <div class="Alogo-container">
        		<img class="Alogos" src="../img/BU-LOGO.png">
        		<img class="Alogos" src="../img/BUHS LOGO.png">
        		<img class="Alogos" src="../img/SSG LOGO.png">
        	</div>
            <p>WELCOME TO THE OFFICIAL</p>
            <h1>ONLINE VOTING SYSTEM</h1>
            <p>BICOL UNIVERSITY COLLEGE OF EDUCATION<br>
                INTEGRATED LABORATORY SCHOOL-HIGH SCHOOL DEPT.</p>
        </article>
    </section>
    <!--Left Content-->

    <!--Proxy Countdown-->
    <aside id="aside-container">
        <h1 id="aheadline">ELECTION COUNTDOWN</h1>
        <div id="acountdown">
            <ul id="AD-CD-contents">
                <li><span id="days">0</span>days</li>
                <li><span id="hours">0</span>Hours</li>
                <li><span id="minutes">0</span>Minutes</li>
                <li><span id="seconds">0</span>Seconds</li>
            </ul>
        </div>
        <p class="Aelec-guide-txt">Welcome to the official Bicol University College of Education
        Integrated Laboratory - High School Department Online Voting System. The system aims to provide mobility among student users to vote electronically anywhere for the annual Student Supreme Government Elections.

        </p>
    </aside>
    <!--End of Proxy Countdown-->

    

    <?php 
       
       include "db_conn.php";
       $event = mysqli_query($conn, "SELECT * FROM vote_event WHERE vote_event_id = 1");
  
       while ($row = mysqli_fetch_array($event)) { 
        $stdate = $row['start_date'];
        $endate = $row['end_date'];
       }
       ?>

    <script>
        $('.ADicon').click(function () {
            $('span').toggleClass("cancel");
        });
     
     
        var start ="<?php echo $stdate ?>"; 

// Set the date we're counting down to
var countDownStart = new Date(start).getTime();


// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownStart - now;

    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
 
  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML =seconds;

  // If the count down is over, write some text 
  if (distance < 0) {
   let headlines = document.getElementById("aheadline");
    headlines.innerText = "Time before \n election ends";
   //delete the data in vote_event table in database after election ends
$(document).ready(function(){
 var dend = "<?php echo $endate ?>"; 
// Set the date we're counting down to
 var cdEnd = new Date(dend).getTime();

// Update the count down every 1 second
 var i = setInterval(function() {

  // Get today's date and time
  var nowww = new Date().getTime();
    
  // Find the distance between now and the count down date

  var distEnd = cdEnd - nowww;
  var d = Math.floor(distEnd / (1000 * 60 * 60 * 24));
  var h = Math.floor((distEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var m = Math.floor((distEnd % (1000 * 60 * 60)) / (1000 * 60));
  var s = Math.floor((distEnd % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
 
  document.getElementById("days").innerHTML = d;
  document.getElementById("hours").innerHTML = h;
  document.getElementById("minutes").innerHTML = m;
  document.getElementById("seconds").innerHTML =s;
    
  // If the count down is over, write some text 
  if (distEnd < 0) {
               let headline = document.getElementById("aheadline"),
                    countdown = document.getElementById("acountdown"),
                    content = document.getElementById("AD-CD-contents");
      
                headline.innerText = "The election period \n has ended!";
                countdown.style.display = "none";
   
                clearInterval(i);
        }
                
},1000);
});
               
                clearInterval(x);
              }

},1000);
	    
    </script>
</body>

</html>
<?php
}else{
	header("Location: ..\index.php");
     exit();
}
 ?>
