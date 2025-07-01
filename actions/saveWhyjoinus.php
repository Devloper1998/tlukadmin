<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_whyjoinus';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

$oldImage     = isset($_POST['oldImage'])?trim($_POST['oldImage']):'';

$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));


$image = '';
$image_targetDir = "../uploads/joinus/";

if(isset($_FILES['image'])) {

    $imagefileName = basename($_FILES["image"]["name"]);
    $targetimageFilePath = $image_targetDir.$randomId. "image".$imagefileName;
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetimageFilePath)) {
        $image = $targetimageFilePath;
        if ($_POST['action'] == 'update') {
            unlink($oldImage);
        }
    }
} else {
    $image = $oldImage;
}



if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $insQry = "INSERT INTO ".$tableName." SET description ='".$description."' ,image ='".$image."',randomId = '".$randomId."'";
	  $insData =$crud->execute($insQry);

        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_whyjoinus order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $upQry = "UPDATE ".$tableName." SET description ='".$description."',image ='".$image."'where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($upQry);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'delete'){

    $delwhyjoin = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delwhyjoin);
    
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

?>