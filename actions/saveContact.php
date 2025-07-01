<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_contact';


$address    = isset($_POST['address'])?trim($_POST['address']):'';
$mobile     = isset($_POST['mobile'])?trim($_POST['mobile']):'';
$email     = isset($_POST['email'])?trim($_POST['email']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));


if(isset($_POST["action"]) && $_POST['action'] == 'update'){

    $UpdateQry = "UPDATE ".$tableName." SET address = '".$address."',mobile = '".$mobile."',email = '".$email."' where  randomId = '".$hdn_id."'";
    $updatedata = $crud->execute($UpdateQry);

  
        if($updatedata)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_contact ";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}



?>