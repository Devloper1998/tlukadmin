<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$mail_sccuess = false;

$firstname = $_POST['first_name'];
$lastname  = $_POST['last_name'];
$useremail = $_POST['email'];
$randomId  = $_POST['randomId'];

$Adminemail = 'kamadibhavani16@gmail.com';
$subject    = "New Subscriber Alert From TLUK";

$filePath = 'https://spondiastech.com/tlukadmin/subadminEmail.html';
$content  = file_get_contents($filePath);

if ($content !== false) {
    $content = str_replace(
        ['{{firstname}}', '{{lastname}}', '{{useremail}}'],
        [$firstname, $lastname, $useremail],
        $content
    );

  
    $dataToSendAdmin = array(
        'subject' => $subject,
        'mail'    => $Adminemail,
        'content' => $content
    );

    $targetUrl = 'https://spondiastech.com/tlukadmin/SMTP/mail.php';
    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToSendAdmin));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Email cURL Error: ' . curl_error($ch));
        $mail_sccuess = false;
    } else {
        $mail_sccuess = true;
    }

    curl_close($ch);
}
?>
