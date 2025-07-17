<?php
include('smtp/PHPMailerAutoload.php');

$mail = $_POST['mail'];
$to = $email;
$subject =$_POST['subject'];
$content = $_POST['content'];
$message= $content;

echo smtp_mailer($mail, $subject, $message);
function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->SMTPDebug  = 3;
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "teluguladiesinuk@gmail.com";
    $mail->Password = "xlsrrihiluezgvln";
    $mail->SetFrom("teluguladiesinuk@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
  }

?>