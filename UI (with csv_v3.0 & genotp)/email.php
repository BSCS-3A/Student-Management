<?php

require_once('PHPMailer/PHPMailer-5.2-stable/PHPMailerAutoload.php');

if(isset($_POST["sendEmail"])){

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();

    //host email
    //palitan na lang sa email ng klase
    $mail->Username = '';

    //host password
    //palitan na lang sa password ng klase
    $mail->Password = '';

    //Email header
    $mail->SetFrom('no-reply');

    $mail->Subject = 'User Credentials for Voting';

    $mail->Body = 'Your one-time-password: ';
    
    while($row = mysqli_fetch_array($result)){

        $user_email = $row['bumail'];
        $user_otp = $row['otp'];

        //Laman ng email
        $mail->Body = 'Your one-time-password: , $user_otp';

        //User email
        $mail->AddAddress($user_email);

    //$mail->Send();

    }
    header("location: StudentAccountManagement.php?updation=1");
}
?>
