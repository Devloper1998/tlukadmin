<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_slider';
$oldVideo    = isset($_POST['oldVideo'])?trim($_POST['oldVideo']):'';


$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

// $image = '';
// $image_targetDir = "../uploads/slider/";

// if(isset($_FILES['image'])) {

//     $imagefileName = basename($_FILES["image"]["name"]);
//     $targetimageFilePath = $image_targetDir.$randomId. "image".$imagefileName;
//     if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetimageFilePath)) {
//         $image = $targetimageFilePath;
//         if ($_POST['action'] == 'update') {
//             unlink($oldImage);
//         }
//     }
// } else {
//     $image = $oldImage;
// }
$video = '';    
$video_targetDir = "../uploads/slider/";

if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
    $videofileName = basename($_FILES["video"]["name"]);
    $targetvideoFilePath = $video_targetDir . $randomId . "_video_" . $videofileName;

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetvideoFilePath)) {
        $video = $targetvideoFilePath;

        // Optionally remove old video on update
        if ($_POST['action'] == 'update' && !empty($oldVideo)) {
            unlink($oldVideo);
        }
    }
} else {
    $video = $oldVideo;
}



if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $inslider = "INSERT INTO ".$tableName." SET image ='".$video."',randomId = '".$randomId."'";
	  $insData =$crud->execute($inslider);

     
  
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_slider order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $upSlider = "UPDATE ".$tableName." SET image ='".$video."' where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($upSlider);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'delete'){

    $delslider= "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delslider);
    
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}

?>