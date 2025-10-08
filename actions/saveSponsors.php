<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_sponsors';
$sponsor_name    = isset($_POST['sponsor_name'])?trim($_POST['sponsor_name']):'';

$oldsponsor_logo    = isset($_POST['oldsponsor_logo'])?trim($_POST['oldsponsor_logo']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));
$sponsor_logo = '';
$sponsor_logo_targetDir = "../uploads/events/";

if(isset($_FILES['sponsor_logo'])){

$sponsor_logofileName = basename($_FILES["sponsor_logo"]["name"]);
 $targetsponsor_logoFilePath = $sponsor_logo_targetDir.$randomId. "sponsor_logo"
        .$sponsor_logofileName;

    if(move_uploaded_file($_FILES["sponsor_logo"]["tmp_name"], $targetsponsor_logoFilePath)){                                                              
    $sponsor_logo = $targetsponsor_logoFilePath;
  }
}
if(isset($_POST["action"]) && $_POST['action'] == 'save'){
	 $insEventQry = "INSERT INTO ".$tableName." SET sponsor_name = '".$sponsor_name."',sponsor_logo = '".$sponsor_logo."',randomId = '".$randomId."'";
	$insData =$crud->execute($insEventQry);
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT * FROM tluk_sponsors order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayShow'){
    $sql_show = "SELECT * FROM tluk_sponsors order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}


if(isset($_POST["action"]) && $_POST['action'] == 'update'){
  
     $upEventQry = "UPDATE ".$tableName." SET sponsor_name = '".$sponsor_name."',sponsor_logo = '".$sponsor_logo."' where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($upEventQry);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'delete'){
  $delevent = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delevent);
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'changeStatus'){ 
  $Upd_Status = "UPDATE ".$tableName." SET status = '".$_POST['status']."' WHERE id='".$_POST['id']."'";
  $Status_data = $crud->execute($Upd_Status);
       if ($Status_data){
           echo "true";
       }else{
           echo "false";
       }
}



?>