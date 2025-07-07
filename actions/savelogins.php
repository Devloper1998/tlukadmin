<?php 
session_start();
include('../crudop/crud.php');
$crud = new Crud;

$tableName = 'tluk_adminlogins';

if(isset($_POST['action']) && $_POST['action'] == 'login'){

$username    = isset($_POST['username'])?trim($_POST['username']):'';
$password    = isset($_POST['password'])?trim($_POST['password']):'';

	 $res_sql = "select * from ".$tableName." where username = '".$username."' and password = '".$password."'";

  	$res_data = $crud->getData($res_sql);

  	if (count($res_data) > 0){
    
	 $_SESSION['username']  = $res_data[0]['username'];
	 $_SESSION['password']  = $res_data[0]['password'];

    	echo "true";
    }else{
      	echo "false";
    }
}

?>