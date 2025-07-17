<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("crudop/crud.php");

$crud = new Crud();
$randomId  = substr(uniqid(), 0, 10);
$username     = $_POST['username'];
$useremail     = $_POST['useremail'];
$phone     = $_POST['phone'];
$message     = $_POST['message'];
$Adminemail    = 'teluguladiesinuk@gmail.com';


$ins_qry = "insert into tluk_UsersVerification set email = '".trim($useremail)."', randomId = '".trim($randomId)."' ";
$ins_data = $crud->execute($ins_qry);
$sel_qery = "select * from tluk_UsersVerification where email='".trim($useremail)."' and randomId = '".$randomId."' ";
$sel_data = $crud->getData($sel_qery);
$rand = mt_rand(1111, 9999);

if ($sel_data) {
    $_SESSION['otp_val']   = $rand;
    $_SESSION['randomId']  = $sel_data[0]['randomId'];

    $subject = "New Contact Request From TLUK";
    $subjectUser = "Your Email Confirmation - TLUK";
    $mail = $Adminemail;

    // Read the content of the HTML file
    $filePath = 'https://teluguladiesinuk.com/admin/adminEmail.html'; 
    $content = file_get_contents($filePath);

    // Replace placeholders with actual values
    $content = str_replace(['{{name}}','{{useremail}}' ,'{{message}}','{{phone}}'], [$username,$useremail, $message,$phone], $content);

    // Load User Email Template
    // $userTemplatePath = 'https://teluguladiesinuk.com/admin/userEmail.html'; 
    // $userContent = file_get_contents($userTemplatePath);
    // $userContent = str_replace(['{{name}}'], [$username], $userContent);

    $dataToSend = array(
        'subject' => $subject,
        'mail' => $mail,
        'content' => $content
    );

     // Prepare data for User Email
    // $dataToSendUser = array(
    //     'subject' => $subjectUser,
    //     'mail' => $useremail,
    //     'content' => $userContent
    // );

    $targetUrl = 'https://teluguladiesinuk.com/admin/SMTP/mail.php';

    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToSend));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    // Send email to User
    // $ch = curl_init($targetUrl);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToSendUser));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $responseUser = curl_exec($ch);
    // if (curl_errno($ch)) {
    //     echo 'User Email cURL Error: ' . curl_error($ch);
    // }
    
    $mail_sccuess = true;
} else {
    $mail_sccuess = false;
} 
?>