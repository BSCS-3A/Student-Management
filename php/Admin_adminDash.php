<?php
session_start();
include('db_conn.php');
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="../css/admin_css/style_AdminDash.css">
        <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_AdminDash.css">
        <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_AdminDash.css">
        <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
        <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_AdminDash.css">
        <!-- <script src="assets/js/a076d05399.js"></script> -->
        <script src="../js/dataTables.bootstrap4.min_adminDash.js"></script>
        <script src="../js/jquery-3.5.1_adminDash.js"></script>
        <script src="../js/jquery.dataTables.min_adminDash.js"></script>
        <!-- <script src="../js/countdown.js"></script> -->
        <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Home (Administrators) | BUCEILS HS Online Voting System</title>
    </head>

    <body>

        <?php include "navAdmin.php" ?>

        <section>
            <!--Left Content-->
            <article>
                <div class="logo-container">
                    <img class="logos" src="../img/BU-LOGO.png">
                    <img class="logos" src="../img/BUHS LOGO.png">
                    <img class="logos" src="../img/SSG LOGO.png">
                </div>
                <p>WELCOME TO THE OFFICIAL</p>
                <h1>ONLINE VOTING SYSTEM</h1>
                <p>BICOL UNIVERSITY COLLEGE OF EDUCATION<br>
                    INTEGRATED LABORATORY SCHOOL-HIGH SCHOOL DEPT.</p>
            </article>
        </section>

        <!--Proxy Countdown-->
        <aside id="ADaside-container">
            <h1 id="AD-CD-headline">ELECTION COUNTDOWN</h1>
            <div id="ADcountdown">
                <ul id="AD-CD-contents">
                    <li><span id="days">0</span>days</li>
                    <li><span id="hours">0</span>Hours</li>
                    <li><span id="minutes">0</span>Minutes</li>
                    <li><span id="seconds">0</span>Seconds</li>
                </ul>
            </div>
            <p class="Aelec-guide-txt">Welcome to the official Bicol University College of Education
                Integrated Laboratory - High School Department Online Voting System. The system aims to provide mobility among student users to vote electronically anywhere for the annual Student Supreme Government Elections. This section allows administrators to conduct the election, manage its process and other necessary information.
            </p>
        </aside>

        <?php

        include "db_conn.php";

        $event = mysqli_query($conn, "SELECT * FROM vote_event WHERE vote_event_id = 1");

        while ($row = mysqli_fetch_array($event)) {
            $stdate = $row['start_date'];
            $endate = $row['end_date'];
        }
        ?>

        <script>
            $('.ADicon').click(function() {
                $('span').toggleClass("cancel");
            });


            var start = "<?php echo $stdate ?>";

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
                document.getElementById("seconds").innerHTML = seconds;

                // If the count down is over, write some text 
                if (distance < 0) {
                    let headlines = document.getElementById("AD-CD-headline");
                    headlines.innerText = "Time before \n election ends";
                    //delete the data in vote_event table in database after election ends
                    $(document).ready(function() {
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
                            document.getElementById("seconds").innerHTML = s;

                            // If the count down is over, write some text 
                            if (distEnd < 0) {
                                let headline = document.getElementById("AD-CD-headline"),
                                    countdown = document.getElementById("ADcountdown"),
                                    content = document.getElementById("AD-CD-contents");

                                headline.innerText = "The election period \n has ended!";
                                countdown.style.display = "none";

                                clearInterval(i);
                            }

                        }, 1000);
                    });

                    clearInterval(x);
                }

            }, 1000);

          //send reminders 1 hour before election ends
          $(document).ready(function() {
                var end = "<?php echo $endate ?>";
                var countDownEnd = new Date(end).getTime();
                
                
           // Update the count down every 1 second
           var y = setInterval(function() {
                var today = new Date();
                var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                var currentTime = date + ' ' + time;
                // Set the date we're counting down to
                
                    
                    
                    // Get today's date and time
                    var noww = new Date().getTime();

                    // Find the distance between now and the count down date

                    var distanceEnd = countDownEnd - noww;
                    var current = new Date(currentTime).getTime();
                    // Time calculations for days, hours, minutes and seconds
                    //time ends
                    var daysEnd = Math.floor(distanceEnd / (1000 * 60 * 60 * 24));
                    var hoursEnd = Math.floor((distanceEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)-1);
                    var minutesEnd = Math.floor((distanceEnd % (1000 * 60 * 60)) / (1000 * 60));
                    var secondsEnd = Math.floor((distanceEnd % (1000 * 60)) / 1000);

                    var cdEnd = countDownEnd - 3600000; //3600000(1hr)
             
                    if (hoursEnd <= 0) {
 
                        if (current == cdEnd) {

                            $.post("./backAdmin/backFun_reminders_v0_1.php",
                                function(data, status) {
                                    //alert("Message sent with status" + status);
                                    //location.reload(true);

                                });
                            clearInterval(y);
                        }
                    }
              
                }, 1000);
            
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: AdminLogin.php");
    exit();
}
?>
