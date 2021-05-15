<?php
include "../db_conn.php";

$sigfname = $_POST['sigfname'];
$siglname = $_POST['siglname'];
$sigpos = $_POST['sigpos'];
$file = file_get_contents('../../other/sig_array.json');
$decode = json_decode($file, true);
$arrtab = explode(",",$decode);
$arrtab = array_filter($arrtab);
$source = null;

$fname_query = "SELECT * FROM admin WHERE admin_fname = '$sigfname'";
$lname_query = "SELECT * FROM admin WHERE admin_lname = '$siglname'";
$position_query = "SELECT * FROM admin WHERE comelec_position = '$sigpos'";

$fname_query_run = mysqli_query($connection, $fname_query);
$lname_query_run = mysqli_query($connection, $lname_query);
$position_query_run = mysqli_query($connection, $position_query);

  if(mysqli_num_rows($fname_query_run) >0){
    if(mysqli_num_rows($lname_query_run) >0){
      if(mysqli_num_rows($position_query_run) >0){


        $sql = "SELECT * FROM admin WHERE admin_lname ='$siglname'";
        $result = mysqli_query($connection,$sql);
          if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $source = $row['admin_id'];
              if(array_search($source,$arrtab) == true){
                echo"<script language='javascript'>
                alert('Signatory already exist');
                window.location.href = '../Admin_signConfig.php';
                </script>
                ";

              }
              else{
                $source = $row['admin_id'];
                $arrtab = implode(",",$arrtab);
                $string = $arrtab .",". $source;
                $encodedString = json_encode($string);
                file_put_contents('../../other/sig_array.json',($encodedString));
                echo"<script language='javascript'>
                alert('Signatory Added');
                
                window.location.href = '../Admin_signConfig.php';
                </script>
                ";
          
                // session action for logs
                $_SESSION['action'] = 'added Signatory : ' . $siglname . ', '. $sigfname ;
                include 'backFun_actLogs_v0_1.php';
              }
            }
          }

      }
      else{
        echo"<script language='javascript'>
        alert('Position does not exist');
        window.location.href = '../Admin_signConfig.php';
        </script>
        ";
      }
    }
    else{
      echo"<script language='javascript'>
      alert('Last Name does not exist');
      window.location.href = '../Admin_signConfig.php';
      </script>
      ";
    }
  }
  else{
    echo"<script language='javascript'>
    alert('First Name does not exist');
    window.location.href = '../Admin_signConfig.php';
    </script>
    ";
  }

  
?>
