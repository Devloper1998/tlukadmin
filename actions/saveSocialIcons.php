<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_icons';


$title    = isset($_POST['title'])?trim($_POST['title']):'';
$link    = isset($_POST['link'])?trim($_POST['link']):'';

$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $insicons = "INSERT INTO ".$tableName." SET title = '".$title."', link ='".$link."',randomId = '".$randomId."'";
	  $insData =$crud->execute($insicons);
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_icons order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $upicons = "UPDATE ".$tableName." SET title = '".$title."', link ='".$link."' where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($upicons);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'delete'){

  $delicons = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delicons);



    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

?>