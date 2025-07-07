<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_contactUsers';
$mail_sccuess= true;

 


if(isset($_POST["action"]) && $_POST['action'] == 'save'){
  
    include("../sendContactEmail.php");
     if($mail_sccuess)
    {

    $InsertQry = "INSERT INTO ".$tableName." SET name = '".$_POST['username']."',surname = '".$_POST['surname']."',email = '".$_POST['useremail']."',phone = '".$_POST['phone']."', message='".$_POST['message']."' , randomId = '".$randomId."'";
    $insertdata = $crud->execute($InsertQry);
        if($insertdata)
        {
          echo "true";
        } else{
          echo "false";
        }
        }
    else
    {
        echo "false";
    }
}


if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_contactUsers order by id desc ";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
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





?>