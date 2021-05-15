<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
// front_Election_v5_0.php
require './backMonitor/fetch_candidates.php';
require './backMonitor/fetch_candidate_position.php';
require './backMonitor/position_vote_count.php';
require './backMonitor/fetch_date.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta charset="utf-8">
  <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style_monitor.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/admin_css/bootstrap4.5.2_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap4.min_monitor.css">
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <link rel="stylesheet" href="../css/admin_css/jquery.dataTables.min_monitor.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="../js/jquery-1.11.1.min_monitor.js"></script>
    <script src="../js/jquery.dataTables.min_monitor.js"></script>
    <script src="../js/dataTables.bootstrap_monitor.js"></script>
    <script src="../js/bootstrap.min_monitor.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>  
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>  
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>   
    <title>Election Results | BUCEILS HS Online Voting System</title>
</head>

<body>
  <?php include 'navAdmin.php'; ?>
  
  <?php
    if(!empty($row['vote_event_id'])){
    echo '<div class="ADheader" id="ADheader">';
      echo '<h2 class="aHeader-txt">ELECTION RESULTS</h2>';
    echo'</div>';

    echo '<div class="Belection_container" id="election_res">';

      for ($i = 0; $i < $size; $i++) {
        echo '<div class="Bposition1">';
        echo '<h1><b>' . $candidate_positions[$i]['position_name'] . '</b></h1>';
        foreach ($candidates as $candidate) {
          if ($candidate['position'] == $candidate_positions[$i]['position_name']) { 
            if ($position_votes[$i]['votes_per_position'] != 0) {
              $percentage = round(($candidate['total_votes'] / $position_votes[$i]['votes_per_position']) * 100);
            } else {
              $percentage = 0;
            }
            
            if(($current_date_time > $row['end_date'])){
              if(empty($candidate['middle_name'])){
                echo '<div class ="Bcan"><b>'.$candidate['first_name'].' '.$candidate['last_name'].'</b></div>';
              }else{
                echo '<div class ="Bcan"><b>'.$candidate['first_name'].' '.$candidate['middle_name'][0].'. '.$candidate['last_name'].'</b></div>';
              }
              echo '<div class ="Bparty"><b>'.$candidate['party_name'].'</b></div>';
              echo '<div class="Bbar1">';
              echo '<img class="Banon" src="'.$candidate['photo'].'" width="40px" height="40px">';
              echo '<div class="Bvote_percentage">';
              echo '<div class="Bvote_level" style="width:' . $percentage . '%">';
              echo '<b><span>'.$candidate['total_votes'].'</span></b>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }else {
              echo '<div class ="Bcan"><b>Candidate Name</b></div>';
              echo '<div class ="Bparty"><b>Party</b></div>';
              echo '<div class="Bbar1">';
              echo '<img class="Banon" src="../img/anon.png" width="40px" height="40px">';
              echo '<div class="Bvote_percentage">';
              echo '<div class="Bvote_level" style="width:'.$percentage.'%">';
              echo '<b><span>'.$percentage.'%</span></b>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          }
        }
        echo '</div>';
      }
    echo '</div>';
    echo '<form action="Admin_ElectRes.php" method="post" target="_self">';
    echo '<div class="Bbtn_post">';
    echo "<button onclick='return confirm('Are you sure?')' type='submit' id='post_button' name='post_button' class='Bbtn_postresults scs-responsive'><b>POST RESULT</b></button>";
    echo '</div>';

    echo '<div class="Bbtn_reset">';
    echo "<button onclick='return confirm('Are you sure?')' type='submit' id='reset_button' name='reset_button' class='Bbtn_resetresults scs-responsive'><b>RESET ELECTION</b></button>";
    echo '</div>';
    echo '</form>';
    }else{
      require '../html/admin_no_election.html';
    }
  ?>

  <?php
    if(isset($_POST['post_button'])){
      $file = fopen("../other/post_result.txt", "w") or die("Unable to open file!");
      
      $flag_post = 1;

      fwrite($file, $flag_post);
    
      fclose($file);
    }

    if(isset($_POST['reset_button'])){
      $truncate_record = mysqli_query($conn, 'TRUNCATE TABLE vote_event');

      $file = fopen("../other/post_result.txt", "w") or die("Unable to open file!");

      $flag_post = 0;

      fwrite($file, $flag_post);

      fclose($file);
    }
  ?>

  <br>
  <br>
  <br>

  <div class="footer">
    <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
  </div>

  <script>
    // $(document).ready(function() {
    //   let autorefresh = setInterval(function() {

    //   }, 1000);
    // }); 
    $('.ADicon').click(function() {
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