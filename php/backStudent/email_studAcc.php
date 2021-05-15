<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//palitan na lang ang location kung nasan ang composer na folder
require '../other/composer/vendor/autoload.php';

if(isset($_POST["sendEmail"])){
   
    $mail = new PHPMailer();
   
    while($row = mysqli_fetch_array($result)){

        try {
                
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';

           // Host email and password
            $mail->Username = 'buceilsovs.noreply@gmail.com';
            $mail->Password = 'mhsyjtryvxhkkfts';
            
            /* Disable some SSL checks. */
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

            $user_otp = $row['otp'];
            $user_email = $row['bumail'];

            //palitan na lang ang mga message
            $mail->SetFrom('BSCS3A@bu.com');
            $mail->Subject = 'User Credentials';
            $mail->Body = "Good day! Your one time password for the current election is $user_otp . Please do not disclose your login credentials. Thank you!";
            $mail->addAddress($user_email);
            
        $mail->send();
        $mail->ClearAllRecipients();
          
        }
            catch (Exception $e){
                echo $e->errorMessage();
            }
            catch (\Exception $e){
                echo $e->getMessage();
            }
        }
   
         //For Logs
         $_SESSION['action'] = "sent students' OTP.";
         include 'backFun_actLogs_v0_1.php';
   
        header("location: Admin_studAcc.php");
}
?>
