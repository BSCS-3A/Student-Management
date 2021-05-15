<!--
    Proj Mngr notes:
    -changed path include
-->

<?php

include('../Admin_schedConfig.php');
require '../../other/composer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// $db = mysqli_connect('localhost', 'root', '', 'bucielsmain2');
include '../db_conn.php';
$results = mysqli_query($db, "SELECT * FROM student");

$mail = new PHPMailer(TRUE);
	
	//initialize variables
	/* $subject = ""; */
	$message = "";

   function function_alert($msg) { 
      
      // Display the alert box  
      echo "<script>
         window.location.href='../Admin_schedConfig.php';
         alert('$msg');
    </script>"; 
  } 

 //Send email
	if (isset($_POST['save'])) {

		/* $subject = $_POST['subject']; */
	$message = $_POST['message'];
      	if(empty($message)){
         function_alert("blank message"); 
      	}else{


      while ($row = mysqli_fetch_array($results)) { 

	try {
   
         $mail->setFrom('buceilsovs.noreply@gmail.com', 'buceilsovs.noreply@gmail.com');
         $mail->addAddress($row['bumail']);
         $mail->Subject = 'BUCEILS HS OVS - Reminders';
         $mail->Body = $message;
         
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
    
     function_alert("Mail Sent"); 
	
    //For Logs
    $_SESSION['action'] = 'sent Election Reminders.';
    include 'backFun_actLogs_v0_1.php';
       
   }
   }else{
      function_alert("Sending failed"); 
	
   }
?>
