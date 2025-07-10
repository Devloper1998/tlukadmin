<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_events';
$event_description    = isset($_POST['event_description'])?trim($_POST['event_description']):'';
$event_name    = isset($_POST['event_name'])?trim($_POST['event_name']):'';
$date    = isset($_POST['date'])?trim($_POST['date']):'';
$start_time    = isset($_POST['start_time'])?trim($_POST['start_time']):'';
$end_time    = isset($_POST['end_time'])?trim($_POST['end_time']):'';
$end_date    = isset($_POST['end_date'])?trim($_POST['end_date']):'';
$description1    = isset($_POST['description1'])?trim($_POST['description1']):'';
$description2    = isset($_POST['description2'])?trim($_POST['description2']):'';
$event_location    = isset($_POST['event_location'])?trim($_POST['event_location']):'';
$oldmain_image    = isset($_POST['oldmain_image'])?trim($_POST['oldmain_image']):'';
$oldhome_image    = isset($_POST['oldhome_image'])?trim($_POST['oldhome_image']):'';
$oldimage    = isset($_POST['oldimage'])?trim($_POST['oldimage']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));
$imageFields = ['main_image',"home_image"]; 
$uploadsDir = "../uploads/events/";
foreach ($imageFields as $field) {
  $oldField = 'old' . $field;
  $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';
  if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
      $fileName = $randomId . "_" . $field . ".webp";
      $targetFilePath = $uploadsDir . $fileName;
      $tempPath = $_FILES[$field]["tmp_name"];
      $sourceImage = imagecreatefromstring(file_get_contents($tempPath));
      if (!$sourceImage) continue;
      $origWidth = imagesx($sourceImage);
      $origHeight = imagesy($sourceImage);
      $newWidth = $origWidth;
      $newHeight = $origHeight;
      if ($field === 'main_image') {
          $newWidth = 800;
          $newHeight = 600;
      } 
      $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
      imagewebp($resizedImage, $targetFilePath, 80);
      imagedestroy($sourceImage);
      imagedestroy($resizedImage);
      $$field = $targetFilePath;
      if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
          unlink($_POST[$oldField]);
      }
  }
}
if(isset($_POST["action"]) && $_POST['action'] == 'save'){
	 $insEventQry = "INSERT INTO ".$tableName." SET event_name = '".$event_name."', date ='".$date."',end_date ='".$end_date."',start_time ='".$start_time."',end_time ='".$end_time."',description1 ='".$description1."',description2 ='".$description2."',main_image ='".$main_image."',home_image ='".$home_image."',event_location ='".$event_location."',randomId = '".$randomId."'";
	$insData =$crud->execute($insEventQry);
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT * FROM tluk_events order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayShow'){
  $sql_show = "SELECT * FROM tluk_events where status = 1 order by id desc";
  $show_data = $crud->getData($sql_show);        
     $response = array(
      "draw" => 1,
      "recordsTotal" => count($show_data),
      "data" => $show_data
  );
  echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){
    $sql_show = "SELECT * FROM tluk_events where id ='".$_POST['event_id']."' order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'update'){
     $upEventQry = "UPDATE ".$tableName." SET event_name = '".$event_name."',date ='".$date."',end_date ='".$end_date."',start_time ='".$start_time."',end_time ='".$end_time."',description1 ='".$description1."',description2 ='".$description2."',main_image ='".$main_image."',home_image ='".$home_image."',event_location ='".$event_location."' where randomId = '".$hdn_id."'";
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
if(isset($_POST["action"]) && $_POST['action'] == 'updatedesc'){
   $updatestory = "UPDATE tluk_eventdescription SET event_description = '".$event_description."' WHERE randomId = '".$hdn_id."'";
   $updatedata = $crud->execute($updatestory);
    if ($updatedata ){
      echo "true";
    }else{
      echo "false";
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayDesc'){
    $sql_show = "SELECT * FROM tluk_eventdescription  order by id desc";
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

?>