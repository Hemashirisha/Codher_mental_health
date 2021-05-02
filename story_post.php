<?php
//include '../DB.php';
include(dirname(__FILE__) . '/DB.php');
//var_dump($_POST);
$filename = $_FILES['file']['name'];
$title=$con->real_escape_string($_POST["story_title"]);
$story=$con->real_escape_string($_POST["story"]);


$location = "story_images/".$filename;
$fileerror=$_FILES['file']['error'];
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);


/* Valid Extensions */
echo "Heyyy";
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}

if($uploadOk == 0){
   echo "Image must be in jpg/jpeg/png format";
}
else{
   if($fileerror===0){
       echo "hooo";
    $filenamenew = uniqid('', true) . "." . $imageFileType;
    $NewLocation=$location = "story_images/".$filenamenew;
      if(move_uploaded_file($_FILES['file']['tmp_name'],$NewLocation)){
        $file=$_FILES['file']['tmp_name'];
        //echo $filename;
        echo $filenamenew;
        $query="INSERT INTO `stories`(`title`, `story`, `story_img`) VALUES('$title','$story','$filenamenew')";
        
        $result = $con->query($query);
        //echo query;
        if($result){
        //  setcookie('about', '', time()-3600, '/');
        //    echo "Successful,";
           echo $filenamenew;
        //    if(file_exists($previousFileLocation)){
        //     chmod($previousFileLocation, 0644);
        //     unlink($previousFileLocation);
        //    }
           
           
        }
        else{
          echo $result;
        }
       } 
      else{
      echo "File not updated";
       }
      }
    else{
     echo $fileerror;
     echo "Haaahahahaha";
    }
}
?>