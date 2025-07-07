<?php
session_start();
include_once("crudop/crud.php");
$crud = new Crud();
$tableName = 'connectdetails';


$Name      = isset($_POST['Name'])?trim($_POST['Name']):'';
$email     = isset($_POST['email'])?trim($_POST['email']):'';
$contact   = isset($_POST['contact'])?trim($_POST['contact']):'';
$randomId       = uniqid(substr(0, 10));


if(isset($_POST['action']) && $_POST['action'] == 'save'){

$ins_details = " insert into ".$tableName." set Name ='".$Name."', email ='".$email."',contact ='".$contact."', randomId = '".$randomId."'";

$details_data = $crud->execute($ins_details);




$dataToSend = array(
		  'subject' =>'Test',
		  'mail' => $email,
		  'content' => 'thank you'
		);
		// URL of the target page to receive the data
		$targetUrl = 'https://jntukbiotech.com/SMTP_mail/mail.php';
		// Initialize cURL session
		$ch = curl_init($targetUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToSend));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute the cURL request and get the response
		$response = curl_exec($ch);
		// Check for cURL errors
		if (curl_errno($ch)) {
		  echo 'cURL Error: ' . curl_error($ch);
		}
		// Close the cURL session
	/*	curl_close($ch);
		
 		if ($response !== false) {
 		  echo 'Response from receiver.php: ' . $response;
 		} else {
 		  echo 'Failed to get response from receiver.php';
 		}*/






if ($details_data){
       echo "true";
     }else{
        echo "false";
    }
}

?>