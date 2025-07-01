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
$tableName = 'tluk_stories';
// $tableName1 = 'tluk_story_images';



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
$oldstory_image1    = isset($_POST['oldstory_image1'])?trim($_POST['oldstory_image1']):'';
$oldstory_image2    = isset($_POST['oldstory_image2'])?trim($_POST['oldstory_image2']):'';
// $oldImage = isset($_POST['oldImage']) ? $_POST['oldImage'] : [];


// $hid_storyid        = isset($_POST['hid_storyid'])? $_POST['hid_storyid']:[];
$hdn_id        = isset($_POST['hdn_id'])?trim($_POST['hdn_id']):'';
$randomId      = uniqid(substr(0, 10));

// $imageFields = ['main_image','profile_image','story_image1','story_image2'];
// $uploadsDir = "../uploads/stories/";


// foreach ($imageFields as $field) {
//     $oldField = 'old' . $field;
//     $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';

//     if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
//         $fileName = basename($_FILES[$field]["name"]);
//         $targetFilePath = $uploadsDir .$randomId. "_" . $field . "_" . $fileName;
//         if (move_uploaded_file($_FILES[$field]["tmp_name"], $targetFilePath)) {
//             $$field = $targetFilePath;
//             if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
//                 unlink($_POST[$oldField]);
//             }
//         }
//     }
// }
$imageFields = ['main_image', 'profile_image', 'story_image1', 'story_image2'];
$uploadsDir = "../uploads/stories/";

foreach ($imageFields as $field) {
    $oldField = 'old' . $field;
    $$field = isset($_POST[$oldField]) ? trim($_POST[$oldField]) : '';

    if (isset($_FILES[$field]) && $_FILES[$field]['name'] != "") {
        $tempPath = $_FILES[$field]["tmp_name"];
        $targetFileName = $randomId . "_" . $field . ".webp";
        $targetFilePath = $uploadsDir . $targetFileName;

        // Load original image into Imagick
        $img = new Imagick($tempPath);
        $img->setImageFormat('webp');
        $img->setImageResolution(72, 72);
        $img->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);

        // Resize based on field
        switch ($field) {
            case 'main_image':
                $img->resizeImage(800, 600, Imagick::FILTER_LANCZOS, 1, true);
                break;
            case 'profile_image':
                $img->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, true);
                break;
            case 'story_image1':
            case 'story_image2':
                $img->resizeImage(1600, 1200, Imagick::FILTER_LANCZOS, 1, true);
                break;
        }

        // Save to disk
        $img->writeImage($targetFilePath);
        $img->clear();
        $img->destroy();

        $$field = $targetFilePath;

        // Delete old file on update
        if ($_POST['action'] == 'update' && file_exists($_POST[$oldField])) {
            unlink($_POST[$oldField]);
        }
    }
}



if(isset($_POST["action"]) && $_POST['action'] == 'save'){

	  $insQry = "INSERT INTO ".$tableName." SET title = '".$title."', name ='".$name."',designation ='".$designation."',main_image ='".$main_image."',profile_image ='".$profile_image."',description1 ='".$description1."',story_image1 ='".$story_image1."',description2 ='".$description2."',story_image2 ='".$story_image2."',randomId = '".$randomId."'";
	  $insData =$crud->insertLastId($insQry);

        // $story_image = '';
        //  $story_image_targetDir = "../uploads/stories/";
        //   $i = 0;

        //       foreach($_FILES['story_image']['name'] as $key => $value){
        //         if(isset($_FILES['story_image'])){

        //         $story_imagefileName = basename($_FILES["story_image"]["name"][$key]);
        //         $targetstory_imageFilePath = $story_image_targetDir."story_image_".$randomId.$key.".jpg";
        //             if(move_uploaded_file($_FILES["story_image"]["tmp_name"][$key], $targetstory_imageFilePath)){
        //                 $story_image = $targetstory_imageFilePath;
        //             }
        //         }else{
        //             $story_image = $oldImage;

        //         }

        //         $inStoryImgtQry = "INSERT INTO ".$tableName1." SET story_id = '".$insData."', story_image ='".$story_image."',randomId = '".$randomId.$i."'";
        //       $imgData =$crud->execute($inStoryImgtQry);
        //     $i++;
        // }


  
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

if(isset($_POST["action"]) && $_POST['action'] == 'Displays'){

    $id = $_POST['title'];

    $sql_shows = "SELECT * FROM tluk_stories where title = '".$id."' order by id desc";

    $show_datas = $crud->getData($sql_shows);        
    $response = array(
        "draw" => 1,
        "recordsTotal" => count($show_datas),
        "data" => $show_datas
    );
    echo json_encode($response);
}


if(isset($_POST["action"]) && $_POST['action'] == 'update'){

   


    $upQry = "UPDATE ".$tableName." SET title = '".$title."', name ='".$name."',designation ='".$designation."',main_image ='".$main_image."',profile_image ='".$profile_image."',description1 ='".$description1."',story_image1 ='".$story_image1."',description2 ='".$description2."',story_image2 ='".$story_image2."' WHERE randomId = '".$hdn_id."'";
    $updateData = $crud->execute($upQry);

    // // Delete old story images
    // $Del_imgs = "DELETE FROM ".$tableName1." WHERE story_id = '".$hid_storyid."'";
    // $del_data = $crud->execute($Del_imgs);

 //    $res_qry = "SELECT * FROM tluk_stories WHERE randomId = '$hdn_id'";
 //    $res_data = $crud->getData($res_qry);
 //    $story_id = $res_data[0]['id'];

  

 //    $story_image_targetDir = "../uploads/stories/";
 //    $i = 0;
 //    // Re-upload new images
 // if (!empty($_FILES['story_image']['name'][0])) {
 //        $uploadDir = '../uploads/stories/';
 //        foreach ($_FILES['story_image']['tmp_name'] as $key => $tmp_name) {
 //            if ($_FILES['story_image']['error'][$key] === 0) {
 //                $fileName = time() . '_' . basename($_FILES['story_image']['name'][$key]);
 //                $targetPath = $uploadDir . $fileName;

 //                if (move_uploaded_file($tmp_name, $targetPath)) {
 //                    // Insert image record into tluk_story_images
 //                    $insert_qry = "INSERT INTO tluk_story_images (story_id, story_image) VALUES ('$story_id', '$targetPath')";
 //                    $crud->execute($insert_qry);
 //                }
 //            }
 //        }
 //    } else {
 //        // If no new images uploaded, retain old images
 //        foreach ($_POST['oldImage'] as $key => $old_image) {
 //            $ins_qry = "INSERT INTO ".$tableName1." SET story_id = '".$hid_storyid."', story_image ='".$old_image."', randomId = '".$randomId.$i."'";
 //            $ins_data = $crud->execute($ins_qry);
 //            $i++;
 //        }
 //    }

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

// if (isset($_POST['action'])&&$_POST['action'] == 'singleDelete') {
    
//    $selDis = "delete from ".$tableName1." where id='".$_POST['Rid']."'";
//    $resSel = $crud->execute($selDis);
    
//     if ($resSel) {
//         echo "true";
//     }else{
//         echo "false";
//     }
// }


?>