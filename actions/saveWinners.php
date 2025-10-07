<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_winners';
$event_name    = isset($_POST['event_name'])?trim($_POST['event_name']):'';
$winner_name    = isset($_POST['winner_name'])?trim($_POST['winner_name']):'';
$sponsor_name    = isset($_POST['sponsor_name'])?trim($_POST['sponsor_name']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

if(isset($_POST["action"]) && $_POST['action'] == 'save'){
	 $insEventQry = "INSERT INTO ".$tableName." SET event_name = '".$event_name."', winner_name = '".$winner_name."',sponsor_name = '".$sponsor_name."',randomId = '".$randomId."'";
	$insData =$crud->execute($insEventQry);
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}
if(isset($_POST["action"]) && $_POST['action'] == 'Display'){
    $sql_show = "SELECT tw.*,te.event_name as ename,ts.sponsor_name as sname FROM tluk_winners as tw left join tluk_events as te on tw.event_name = te.id  left join tluk_sponsors as ts on ts.id = tw.sponsor_name order by tw.id desc";
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayShow'){
  $sql_show = "SELECT * FROM tluk_winners WHERE status = 1 ORDER BY (sorting_order = 0 OR sorting_order IS NULL) ASC, sorting_order ASC";
  $show_data = $crud->getData($sql_show);        
     $response = array(
      "draw" => 1,
      "recordsTotal" => count($show_data),
      "data" => $show_data
  );
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
if(isset($_POST["action"]) && $_POST['action'] == 'update'){
     $upEventQry = "UPDATE ".$tableName." SET event_name = '".$event_name."', winner_name = '".$winner_name."',sponsor_name = '".$sponsor_name."' where randomId = '".$hdn_id."'";
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