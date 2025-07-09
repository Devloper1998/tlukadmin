<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_registers';
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $showqry = "SELECT * FROM tluk_registers";
    $showdata = $crud->getData($showqry);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($showdata),
        "data" => $showdata
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'delete'){
  $delqry = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
  $deldata = $crud->execute($delqry);
    if ($deldata){
      echo "true";
    }else{
      echo "false";
    }
}
?>