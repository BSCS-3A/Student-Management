<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
require '../../other/composer/vendor/autoload.php';
 // $db = mysqli_connect('localhost', 'root', '', 'admin_man');
include "../db_conn.php";
$reminders = mysqli_query($conn, "SELECT * FROM student WHERE voting_status = 0"); // pa edit na lang depende kung ano database na gamit

$mail = new PHPMailer(TRUE);
	
 
while ($row = mysqli_fetch_array($reminders)) { 

      try {

       $mail->setFrom('buceilsovs.noreply@gmail.com', 'buceilsovs.noreply@gmail.com');
       $mail->addAddress($row['bumail']);// pa edit na lang depende kung ano database na gamit
       $mail->Subject = 'BUCEILS HS OVS - Reminders';
       $mail->Body = 'Good day!
      
       Please be reminded that you have not yet voted for the election. You only have one hour before the online ballot closes.
      
    Thank you.'; //pa edit na lang nung dapat na nakasulat
      
       /* SMTP parameters. */
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = TRUE;
       $mail->SMTPSecure = 'tls';
       $mail->Username = 'buceilsovs.noreply@gmail.com';
       $mail->Password = 'mhsyjtryvxhkkfts';
       $mail->Port = 587;
   
          /* Enable SMTP debug output. */
         // $mail->SMTPDebug = 4;
      
      /* Disable some SSL checks. */
       $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
       );
      
     
     
    }
    catch (Exception $e)
    {
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       echo $e->getMessage();
    }
 }
 /* Finally send the mail. */
    $mail->send(); 

 	//For Logs
	$_SESSION['action'] = 'sent Last Reminders.';
 	include 'backFun_actLogs_v0_1.php';


?>
