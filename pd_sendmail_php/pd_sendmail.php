<?php
require("PHPMailer.php");
require("SMTP.php");
require("Exception.php");
include("env.php");

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$email_body = "<p>First Name : $fname </p><br>"."<p>Last Name : $lname</p><br>"."<p>Email ID : $visitor_email</p><br>".$message."<br>";

try {
    $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
    $mail->isSMTP();                                         
    $mail->Host       = getenv('Host');
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = getenv('Username');
    $mail->Password   = getenv('Password');                       
    $mail->SMTPSecure = $mail::ENCRYPTION_STARTTLS;         
    $mail->Port       = getenv('Port');                                

    $mail->setFrom('', ' -- name -- s');      // ( new from email < contact info new email id > , from name )
    $mail->addAddress('', 'Hiranyagarbha');     // hg info mail <info@hg.com> 

    $mail->isHTML(true);               
    $mail->Subject = $subject;
    $mail->Body    = $email_body;
    $mail->AltBody = 'Empty. Error';

    $mail->send();
    
    header("Location: https://www.hiranya-garbha.com");
    exit();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>