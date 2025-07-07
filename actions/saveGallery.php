<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_gallery';
$oldheader_logo    = isset($_POST['oldheader_logo'])?trim($_POST['oldheader_logo']):'';

$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

$header_logo = '';
$header_logo_targetDir = "../uploads/gallery/";

if(isset($_FILES['header_logo'])) {

    $header_logofileName = basename($_FILES["header_logo"]["name"]);
    $targetheader_logoFilePath = $header_logo_targetDir.$randomId. "header_logo".$header_logofileName;
    if(move_uploaded_file($_FILES["header_logo"]["tmp_name"], $targetheader_logoFilePath)) {
        $header_logo = $targetheader_logoFilePath;
        if ($_POST['action'] == 'update') {
            unlink($oldheader_logo);
        }
    }
} else {
    $header_logo = $oldheader_logo;
}



if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $inslogo = "INSERT INTO ".$tableName." SET gallery_image ='".$header_logo."',randomId = '".$randomId."'";
	  $insData =$crud->execute($inslogo);

     
  
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_gallery order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $updatelogo = "UPDATE ".$tableName." SET gallery_image ='".$header_logo."' where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($updatelogo);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'delete'){

    $dellogo = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($dellogo);
    
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

?>