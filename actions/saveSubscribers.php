<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_subscribers';
$randomId = uniqid();
$mail_sccuess= true;
if(isset($_POST["action"]) && $_POST['action'] == 'save'){
    include("../sendSubscriberEmail.php");
     if($mail_sccuess)
    {
    $InsertQry = "INSERT INTO ".$tableName." SET firstname = '".$_POST['first_name']."',lastname = '".$_POST['last_name']."',email = '".$_POST['email']."' ,randomId = '".$randomId."'";
    $insertdata = $crud->execute($InsertQry);
        if($insertdata)
        {
          echo "true";
        } else{
          echo "false";
        }
        }
    else
    {
        echo "false";
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT * FROM tluk_subscribers order by id desc ";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'delete'){
  $delstory = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delstory);
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}
?>