<!--Election Results (Student)-->
<?php
    require './backMonitor/fetch_candidates.php';
?>

      <div class="bheader">
        <h3>
          ELECTION RESULTS
        </h3>
      </div>

    <div class="Belec_container" id="candidate">  
        <?php
            foreach($candidates as $candidate){
                echo '<div class="Bposition">';
                if(empty($candidate['photo'])){
                  echo '<img src="../img/admin_anon.png" width="40px" height="40px"/>';
                }else{
                  echo '<img src="'.$candidate['photo'].'" width="40px" height="40px"/>';
                }
                echo '<p class="Bnum_votes">TOTAL VOTES: '.$candidate['total_votes'].'</p>';
                echo '<p class="Bname">'.$candidate['first_name'].' '.$candidate['middle_name'].' '.$candidate['last_name'].'</p>';
                echo '<p class="Bposition">'.$candidate['position'].'</p>';
                echo '<p class="Bparty">'.$candidate['party_name'].'</p>';
                echo '</div>';
            }
        ?>
    </div>
