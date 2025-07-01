<?php 
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


include_once("../crudop/crud.php");
$crud = new Crud();
$tableName = 'tluk_featurebussines';
// print_r($_POST);
// exit;


$business_description    = isset($_POST['business_description'])?trim($_POST['business_description']):'';
$catg_id    = isset($_POST['catg_id'])?trim($_POST['catg_id']):'';
$title    = isset($_POST['title'])?trim($_POST['title']):'';
$description    = isset($_POST['description'])?trim($_POST['description']):'';
$discount    = isset($_POST['discount'])?trim($_POST['discount']):'';
$address    = isset($_POST['address'])?trim($_POST['address']):'';
$business_url    = isset($_POST['business_url'])?trim($_POST['business_url']):'';
$accounts    = isset($_POST['accounts'])?trim($_POST['accounts']):'';
$account_link    = isset($_POST['account_link'])?trim($_POST['account_link']):'';
$oldmain_image    = isset($_POST['oldmain_image'])?trim($_POST['oldmain_image']):'';
$oldbusiness_logo    = isset($_POST['oldbusiness_logo'])?trim($_POST['oldbusiness_logo']):'';
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));


// $imageFields = ['main_image','business_logo'];
// $uploadsDir = "../uploads/business/";


// foreach ($imageFields as $field) {
//     $oldField = 'old' . $field;
//     $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';

//     if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
//         $fileName = basename($_FILES[$field]["name"]);
//         $targetFilePath = $uploadsDir . $randomId ."_" . $field . "_" . $fileName;
//         if (move_uploaded_file($_FILES[$field]["tmp_name"], $targetFilePath)) {
//             $$field = $targetFilePath;
//             if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
//                 unlink($_POST[$oldField]);
//             }
//         }
//     }
// }
$imageFields = ['main_image', 'business_logo']; 
$uploadsDir = "../uploads/business/";

foreach ($imageFields as $field) {
    $oldField = 'old' . $field;
    $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';

    if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
        $originalFileName = basename($_FILES[$field]["name"]);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $tempFilePath = $_FILES[$field]["tmp_name"];

        // Define new filename (force webp for main_image)
        $newFileName = $randomId . "_" . $field;
        $targetFilePath = $uploadsDir . $newFileName;

        // 🟢 Process main_image: convert to .webp + set DPI 72
        if ($field === 'main_image') {
            $finalFilePath = $targetFilePath . '.webp';

            $img = new Imagick($tempFilePath);
            $img->setImageFormat('webp');
            $img->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);
            $img->setImageResolution(72, 72);
            $img->writeImage($finalFilePath);
            $img->clear();
            $img->destroy();

            $$field = $finalFilePath;
        }
        // 🟡 Process business_logo: keep original format
        else {
            $finalFilePath = $targetFilePath . "." . $extension;

            if (move_uploaded_file($tempFilePath, $finalFilePath)) {
                $$field = $finalFilePath;
            }
        }

        // Delete old file if updating
        if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
            unlink($_POST[$oldField]);
        }
    }
}



if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	 $insQry = "INSERT INTO ".$tableName." SET catg_id = '".$catg_id."',title = '".$title."', description ='".$description."',main_image ='".$main_image."',discount ='".$discount."',business_url ='".$business_url."',accounts ='".$accounts."',account_link ='".$account_link."',address ='".$address."',business_logo ='".$business_logo."',randomId = '".$randomId."'";
	  $insData =$crud->execute($insQry);

      
  
        if($insData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'Display'){

    $sql_show = "SELECT * FROM tluk_featurebussines ORDER BY featuredstatus DESC, id DESC;";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){

    $sql_show = "SELECT * FROM tluk_featurebussines where title ='".$_POST['title']."' order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}
if(isset($_POST["action"]) && $_POST['action'] == 'DisplayFeatured'){

    $sql_show = "SELECT * FROM tluk_featurebussines where featuredstatus = 1 order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'DisplayNonFeatured'){

    $sql_show = "SELECT * FROM tluk_featurebussines where featuredstatus = 0 order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}

if(isset($_POST["action"]) && $_POST['action'] == 'update'){

     $upQry = "UPDATE ".$tableName." SET catg_id = '".$catg_id."',title = '".$title."', description ='".$description."',main_image ='".$main_image."',discount ='".$discount."',business_url ='".$business_url."',accounts ='".$accounts."',account_link ='".$account_link."',address ='".$address."',business_logo ='".$business_logo."' where randomId = '".$hdn_id."'";
    $updateData =$crud->execute($upQry);
        if($updateData)
        {
          echo "true";
        } else{
          echo "false";
        }
}

if(isset($_POST["action"]) && $_POST['action'] == 'delete'){

  $delbusiness = "DELETE FROM ".$tableName." where id = '".$_POST['id']."'";
    $deldata = $crud->execute($delbusiness);



    if ($deldata ){
      echo "true";
    }else{
      echo "false";
    }
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

if(isset($_POST["action"]) && $_POST['action'] == 'updatedesc'){

   $updatestory = "UPDATE tluk_businessdescription SET business_description = '".$business_description."' WHERE randomId = '".$hdn_id."'";
   $updatedata = $crud->execute($updatestory);

    if ($updatedata ){
      echo "true";
    }else{
     
      echo "false";
    }
}

if(isset($_POST["action"]) && $_POST['action'] == 'DisplayDesc'){

    $sql_show = "SELECT * FROM tluk_businessdescription  order by id desc";
 
    $show_data = $crud->getData($sql_show);        
       $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_data),
        "data" => $show_data
    );
    echo json_encode($response);
}


if (isset($_POST['action']) && $_POST['action'] == 'changeStatusFeature'){   
      
   $Upd_Status = "UPDATE ".$tableName." SET featuredstatus  = '".$_POST['status']."' WHERE id='".$_POST['id']."'";

        $Status_data = $crud->execute($Upd_Status);

        if ($Status_data){
            echo "true";
        }else{
            echo "false";
        }
}

?>