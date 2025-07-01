<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_categories';


$category_name    = isset($_POST['category_name'])?trim($_POST['category_name']):'';

$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $insQry = "INSERT INTO ".$tableName." SET category_name = '".$category_name."', randomId = '".$randomId."'";
	  $insData =$crud->execute($insQry);

      
  
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_categories order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){

    $sql_show = "SELECT * FROM tluk_categories where id ='".$_POST['id']."' order by id desc ";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $upEventQry = "UPDATE ".$tableName." SET category_name = '".$category_name."' where randomId = '".$hdn_id."'";
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

if (isset($_POST['action']) && $_POST['action'] == 'verify_category') {
  
    $catqry = "select * from ".$tableName." where category_name = '".$_POST['v']."'";
    
    $catdata = $crud->getData($catqry);

    if (count($catdata)>0){
     
      echo "true";
    }
    else{
      echo "false";
    }
  }
?>