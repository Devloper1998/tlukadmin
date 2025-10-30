<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_winners';
$tableName1 = 'tluk_winnerslist';
$event_name    = isset($_POST['event_name'])?trim($_POST['event_name']):'';
$event_title    = isset($_POST['event_title'])?trim($_POST['event_title']):'';
$event_description    = isset($_POST['event_description'])?trim($_POST['event_description']):'';
$eventcategory_name    = isset($_POST['eventcategory_name'])?trim($_POST['eventcategory_name']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$rand      = uniqid(substr(0, 10));
if(isset($_POST["action"]) && $_POST['action'] == 'save'){
    
    // print_r($_POST);
    // print_r($_FILES);
    // exit;

    

	 $insEventQry = "INSERT INTO ".$tableName." SET event_name = '".$event_name."',eventcategory_name = '".$eventcategory_name."',randomId ='".$rand."'";
    $insData =$crud->insertLastId($insEventQry);
    $countfiles = $_POST['rowcounts'];

  for ($i=0; $i < $countfiles ; $i++) { 

  $winner_name    = $_POST['winner_name'][$i];
  $gift    = $_POST['gift'][$i];
  $winnerOrder    = $_POST['winnerOrder'][$i];
$randomId = $rand.$i;
 $sponsor_name = isset($_POST['sponsor_name'][$i]) ? $_POST['sponsor_name'][$i] : [];
        if (!is_array($sponsor_name)) {
            $sponsor_name = [$sponsor_name];
        }
        $sponsor_list = implode(',', $sponsor_name);
 $image = '';
$image_targetDir = "../uploads/winners/";
if (!is_dir($image_targetDir)) {
    mkdir($image_targetDir, 0777, true);
}

if (isset($_FILES['image']['name'][$i]) && $_FILES['image']['name'][$i] != '') {
    $imagefileName = basename($_FILES["image"]["name"][$i]);
    $imageTmpName  = $_FILES["image"]["tmp_name"][$i];
    $uniqueFileName = $randomId . "_image_" . time() . "_" . $imagefileName;
    $targetimageFilePath = $image_targetDir . $uniqueFileName;
    if (move_uploaded_file($imageTmpName, $targetimageFilePath)) {
        $image = $targetimageFilePath;
    } else {
        $image = ''; 
    }
} 

    $winnerQry = "insert into tluk_winnerslist set winner_id ='".$insData."', winner_name = '".$winner_name."', gift = '".$gift."',sponsor_name = '".$sponsor_list."',image ='".$image."',winner_order= '".$winnerOrder."',randomId = '".$randomId."'";
   
      $result = $crud->execute($winnerQry);
  }
        if($result)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT tw.*,tec.category_name,te.event_name as ename,ts.sponsor_name as sname FROM tluk_winners as tw left join tluk_events as te on tw.event_name = te.id  left join tluk_sponsors as ts on ts.id = tw.sponsor_name  left join tluk_eventcategories as tec on tw.eventcategory_name = tec.id order by tw.id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if (isset($_POST["action"]) && $_POST['action'] == 'DisplayShow') { 
    // $sql_show = "SELECT tw.id,twl.winner_name, tw.status, tw.randomId, tw.sponsor_logo, te.event_name AS event_name, tec.category_name, ts.sponsor_name as sname,twl.gift,tw.sorting_order,twl.*  FROM tluk_winners AS tw LEFT JOIN tluk_events AS te ON tw.event_name = te.id left join tluk_winnerslist as twl on twl.winner_id = tw.id LEFT JOIN tluk_sponsors AS ts ON twl.sponsor_name = ts.id left join tluk_eventcategories as tec on tec.id = tw.eventcategory_name ORDER BY CASE WHEN tw.sorting_order IS NULL OR tw.sorting_order = 0 THEN 1 ELSE 0 END, CAST(tw.sorting_order AS UNSIGNED) ASC, tw.id DESC;";
    $sql_show ="SELECT 
    tw.id,
    tw.randomId,
    tw.status,
    tw.sponsor_logo,
    tw.sorting_order,
    te.event_name AS event_name,
    tec.category_name,
    twl.id AS winnerListId,
    twl.winner_name,
    twl.gift,
    twl.winner_order,
    twl.image AS winner_image,
    ts.sponsor_name AS sname
FROM 
    tluk_winnerslist AS twl
LEFT JOIN 
    tluk_winners AS tw ON twl.winner_id = tw.id
LEFT JOIN 
    tluk_events AS te ON tw.event_name = te.id
LEFT JOIN 
    tluk_eventcategories AS tec ON tec.id = tw.eventcategory_name
LEFT JOIN 
    tluk_sponsors AS ts ON FIND_IN_SET(ts.id, twl.sponsor_name)
ORDER BY 
    CAST(twl.winner_order AS UNSIGNED) ASC,
    CASE 
        WHEN tw.sorting_order IS NULL OR tw.sorting_order = 0 THEN 1 
        ELSE 0 
    END,
    CAST(tw.sorting_order AS UNSIGNED) ASC,
    tw.id DESC;";

    $show_data = $crud->getData($sql_show);
    foreach ($show_data as &$row) {
        $row['event_name'] = $row['event_name'] ?? '';
        $row['sponsor_name'] = $row['sponsor_name'] ?? '';
    }
    $response = [
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data  
    ];
    echo json_encode($response);
}




if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){
    $sql_show = "SELECT * FROM tluk_winners where id ='".$_POST['event_id']."' order by id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
// if(isset($_POST["action"]) && $_POST['action'] == 'update'){
//      $upEventQry = "UPDATE ".$tableName." SET event_name = '".$event_name."', winner_name = '".$winner_name."', gift = '".$gift."',sponsor_name = '".$sponsor_name."' where randomId = '".$hdn_id."'";
//     $updateData =$crud->execute($upEventQry);
//         if($updateData)
//         {
//           echo "true";
//         } else{
//           echo "false";
//         }
// }
if (isset($_POST["action"]) && $_POST['action'] == 'update') {

    // print_r($_POST);
    // print_r($_FILES);
    // exit;

    $event_name = $_POST['event_name'];
    $eventcategory_name = $_POST['eventcategory_name'];
    $hdn_id = $_POST['hdn_id']; 
    $winner_id = $_POST['winner_id'];
    $upEventQry = "UPDATE $tableName  
                   SET event_name = '$event_name',
                       eventcategory_name = '$eventcategory_name'
                   WHERE randomId = '$hdn_id'";
    $updateEventData = $crud->execute($upEventQry);
    
    $rowCount = $_POST['rowcounts'];

for ($i = 0; $i < $rowCount; $i++) {
    $winner_name = $_POST['winner_name'][$i];
    $gift = $_POST['gift'][$i];
     $sponsor_name = isset($_POST['sponsor_name'][$i]) ? $_POST['sponsor_name'][$i] : [];
        $sponsor_list = implode(',', (array)$sponsor_name);
    $winnerOrder = $_POST['winnerOrder'][$i];
    $old_image = $_POST['old_image'][$i];
    $hidden_id = $_POST['hidden_id'][$i];
    $winner_id = $_POST['winner_id'];

    $uploadDir = "../uploads/winners/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imagePath = $old_image; 
    if (isset($_FILES['winner_image']['name'][$i]) && $_FILES['winner_image']['name'][$i] != '') {
        $fileName = basename($_FILES['winner_image']['name'][$i]);
        $tmpName  = $_FILES['winner_image']['tmp_name'][$i];
        $newFileName = uniqid() . "_image_" . time() . "_" . $fileName;
        if (move_uploaded_file($tmpName, $uploadDir . $newFileName)) {
            if (!empty($old_image) && file_exists($old_image)) {
                unlink($old_image);
            }
            $imagePath = $uploadDir . $newFileName;
        }
    }

    if (!empty($hidden_id)) {
        $update = "UPDATE tluk_winnerslist 
                   SET winner_name='$winner_name', gift='$gift', sponsor_name='$sponsor_list', image='$imagePath',winner_order ='".$winnerOrder."' 
                   WHERE randomId='$hidden_id'";
        $updateResult = $crud->execute($update);
    } else {
        $newRandId = uniqid();
        $insert = "INSERT INTO tluk_winnerslist set winner_id ='".$winner_id."',winner_name ='".$winner_name."',gift='".$gift."',sponsor_name='".$sponsor_list."',winner_order ='".$winnerOrder."',image='".$imagePath."',randomId='".$newRandId."'";
        $result = $crud->execute($insert);
    }
}
    if($updateResult) {
        echo "true";
    } else {
        echo "false";
    }
}





if(isset($_POST["action"]) && $_POST['action'] == 'delete'){
  $delevent = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delevent);

    $delEventList = "DELETE FROM tluk_winnerslist where winner_id = '".$_POST['id']."'";
    $deldata = $crud->execute($delEventList);
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'updatedesc'){
   $updatestory = "UPDATE tluk_spotlightdescription SET event_title ='".$event_title."',event_description = '".$event_description."' WHERE randomId = '".$hdn_id."'";
   $updatedata = $crud->execute($updatestory);
    if ($updatedata ){
      echo "true";
    }else{
      echo "false";
    }
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayDesc'){
    $sql_show = "SELECT * FROM tluk_spotlightdescription  order by id desc";
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

if(isset($_POST["action"]) && $_POST['action'] == 'deleteList'){

   
     $delEventList = "DELETE FROM tluk_winnerslist where randomId = '".$_POST['id']."'";
    $deldata = $crud->execute($delEventList);
    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
}
?>