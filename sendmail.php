<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['submitContact']))
{
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'jasaulhaqbinfarook@gmail.com';                     //SMTP username
        $mail->Password   = 'dlorlvgowolocwue';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jasaulhaqbinfarook@gmail.com', 'Jasaul Haq');
        $mail->addAddress('jasaulhaqbinfarook@gmail.com', 'Jasaul Haq');     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New enquiry - Jasaul Haq Contact Form';
        $mail->Body    = '<h3>Hello, you got a new enquiry</h3>
        <h4>Fullname: '.$fullname.' </h4>
        <h4>Email: '.$email.' </h4>
        <h4>Subject: '.$subject.' </h4>
        <h4>Message: '.$message.' </h4>
        ';

    if( $mail->send())
    {
        $_SESSION['status'] = "Thank you for contacting me - Jasaul Haq";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }

       
       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else{
    header('Location: index2.html');
    exit(0);
}


?>