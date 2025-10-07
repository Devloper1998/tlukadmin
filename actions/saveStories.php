<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_stories';
$story_description    = isset($_POST['story_description'])?trim($_POST['story_description']):'';
$title    = isset($_POST['title'])?trim($_POST['title']):'';
$name    = isset($_POST['name'])?trim($_POST['name']):'';
$designation    = isset($_POST['designation'])?trim($_POST['designation']):'';
// $date    = isset($_POST['date'])?trim($_POST['date']):'';
// $start_time    = isset($_POST['start_time'])?trim($_POST['start_time']):'';
// $end_time    = isset($_POST['end_time'])?trim($_POST['end_time']):'';
$description1    = isset($_POST['description1'])?trim($_POST['description1']):'';
$description2    = isset($_POST['description2'])?trim($_POST['description2']):'';
$oldmain_image    = isset($_POST['oldmain_image'])?trim($_POST['oldmain_image']):'';
$oldprofile_image    = isset($_POST['oldprofile_image'])?trim($_POST['oldprofile_image']):'';
// $oldstory_image1    = isset($_POST['oldstory_image1'])?trim($_POST['oldstory_image1']):'';
// $oldstory_image2    = isset($_POST['oldstory_image2'])?trim($_POST['oldstory_image2']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));
// $imageFields = ['main_image', 'profile_image', 'story_image1', 'story_image2'];
// $uploadsDir = "../uploads/stories/";
// foreach ($imageFields as $field) {
//     $oldField = 'old' . $field;
//     $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';
//     if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
//         $tempPath = $_FILES[$field]["tmp_name"];
//         $targetFileName = $randomId . "_" . $field . ".webp";
//         $targetFilePath = $uploadsDir . $targetFileName;
//         $img = new Imagick($tempPath);
//         $img->setImageFormat('webp');
//         $img->setImageResolution(100, 100);
//         $img->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);
//         switch ($field) {
//             case 'main_image':
//                 $img->resizeImage(800, 600, Imagick::FILTER_LANCZOS, 1, true);
//                 break;
//             case 'profile_image':
//                 $img->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, true);
//                 break;
//             case 'story_image1':
//             case 'story_image2':
//                 $img->resizeImage(1600, 1200, Imagick::FILTER_LANCZOS, 1, true);
//                 break;
//         }
//         $img->writeImage($targetFilePath);
//         $img->clear();
//         $img->destroy();
//         $$field = $targetFilePath;
//         if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
//             unlink($_POST[$oldField]);
//         }
//     }
// }

$imageFields = ['main_image', 'profile_image'];
$uploadsDir = "../uploads/stories/";

// Image Resize & Convert to WebP using GD
function processImageWithGD($srcPath, $destPath, $width, $height) {
    $info = getimagesize($srcPath);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $srcImage = imagecreatefromjpeg($srcPath);
            break;
        case 'image/png':
            $srcImage = imagecreatefrompng($srcPath);
            break;
        case 'image/webp':
            $srcImage = imagecreatefromwebp($srcPath);
            break;
        default:
            return false;
    }

    $resizedImage = imagescale($srcImage, $width, $height);
    imagewebp($resizedImage, $destPath, 80);
    imagedestroy($srcImage);
    imagedestroy($resizedImage);
    return true;
}

foreach ($imageFields as $field) {
    $oldField = 'old' . $field;
    $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';

    if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
        $tempPath = $_FILES[$field]["tmp_name"];
        $targetFileName = $randomId . "_" . $field . ".webp";
        $targetFilePath = $uploadsDir . $targetFileName;

        switch ($field) {
            case 'main_image':
                processImageWithGD($tempPath, $targetFilePath, 800, 600);
                break;
            case 'profile_image':
                processImageWithGD($tempPath, $targetFilePath, 400, 400);
                break;
        }

        $$field = $targetFilePath;

        if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
            unlink($_POST[$oldField]);
        }
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'save'){
	  $insQry = "INSERT INTO ".$tableName." SET title = '".$title."', name ='".$name."',designation ='".$designation."',main_image ='".$main_image."',profile_image ='".$profile_image."',description1 ='".$description1."',randomId = '".$randomId."'";
	  $insData =$crud->insertLastId($insQry);
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT * FROM tluk_stories order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayShow'){
    $sql_show = "SELECT * FROM tluk_stories where status = 1 order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){
    $id = $_POST['story_id'];
    $sql_shows = "SELECT * FROM tluk_stories where id = '".$id."' order by id desc";
    $show_datas = $crud->getData($sql_shows);        
    $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_datas),
        "data" => $show_datas
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'update'){
    $upQry = "UPDATE ".$tableName." SET title = '".$title."', name ='".$name."',designation ='".$designation."',main_image ='".$main_image."',profile_image ='".$profile_image."',description1 ='".$description1."'  WHERE randomId = '".$hdn_id."'";
    $updateData = $crud->execute($upQry);
    if($updateData)
    {
        echo "true";
    } else{
        echo "false";
    }
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
if(isset($_POST["action"]) && $_POST['action'] == 'updatedesc'){
   $updatestory = "UPDATE tluk_storydescription SET story_description = '".$story_description."' WHERE randomId = '".$hdn_id."'";
   $updatedata = $crud->execute($updatestory);
    if ($updatedata ){
      echo "true";
    }else{
      echo "false";
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayDesc'){
    $sql_show = "SELECT * FROM tluk_storydescription  order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
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

 if(isset($_POST["action"]) && $_POST['action'] == 'updateSortingOrder'){

    $upOrder = "UPDATE ".$tableName." SET sorting_order = '".$_POST['sorting_order']."' where id = '".$_POST['id']."'";
    $updateOrderData =$crud->execute($upOrder);
        if($updateOrderData)
        {
          echo "true";
        } else{
          echo "false";
        }
}


?>