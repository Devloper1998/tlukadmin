<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_about';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$description1 = isset($_POST['description1']) ? trim($_POST['description1']) : '';
$oldImage     = isset($_POST['oldImage'])?trim($_POST['oldImage']):'';
$oldImage1     = isset($_POST['oldImage1'])?trim($_POST['oldImage1']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));
$image = '';
$image_targetDir = "../uploads/about/";
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
$image1 = '';
$image1_targetDir = "../uploads/about/";

if (isset($_FILES['image1']) && $_FILES['image1']['error'] === 0) {
    $image1fileName = basename($_FILES["image1"]["name"]);
    $tempPath = $_FILES["image1"]["tmp_name"];
    $newFileName = $randomId . "_image1.webp";
    $targetImage1FilePath = $image1_targetDir . $newFileName;

    $source = imagecreatefromstring(file_get_contents($tempPath));
    imagepalettetotruecolor($source);
    imagewebp($source, $targetImage1FilePath, 80); // Quality 80
    imagedestroy($source);

    $image1 = $targetImage1FilePath;

    if ($_POST['action'] == 'update' && !empty($oldImage1) && file_exists($oldImage1)) {
        unlink($oldImage1);
    }
}


if(isset($_POST["action"]) && $_POST['action'] == 'update'){
    $UpdateQry = "UPDATE ".$tableName." SET description = '".$description."',description1 = '".$description1."',image = '".$image."',image1 = '".$image1."' where  randomId = '".$hdn_id."'";
    $updatedata = $crud->execute($UpdateQry);
        if($updatedata)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT * FROM tluk_about order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
?>