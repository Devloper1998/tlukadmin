<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_empowerment';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$oldImage     = isset($_POST['oldImage'])?trim($_POST['oldImage']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));
$image = '';
$image_targetDir = "../uploads/empowerment/";
$finalImagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imagefileName = basename($_FILES["image"]["name"]);
    $tempPath = $_FILES["image"]["tmp_name"];
    $newFileName = $randomId . "_image.webp";
    $targetImageFilePath = $image_targetDir . $newFileName;
    $img = new Imagick($tempPath);
    $img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
    $img->setImageResolution(100, 100);
    $img->setImageFormat("webp");
    $img->writeImage($targetImageFilePath);
    $img->clear();
    $img->destroy();
    $image = $targetImageFilePath;
    if ($_POST['action'] == 'update' && !empty($oldImage) && file_exists($oldImage)) {
        unlink($oldImage);
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
    $sql_show = "SELECT * FROM tluk_empowerment order by id desc";
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
    $delempowerment = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delempowerment);
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

?>