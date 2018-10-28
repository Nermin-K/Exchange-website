<?php
$image_error="";
$name=$_FILES["pic"]["name"];
$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["pic"]["name"]);
echo $target_file."</br>";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $image_error.= "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if(isset($name))
{

    if(!empty($name))
    {
        if (file_exists($target_file)) 
        {
          $image_error.= "Sorry, file already exists.Please, change the file name.";
          $uploadOk = 0;
        }

    }
    else $uploadOk=0;

}
 else $uploadOk=0;
// Check file size
//if ($_FILES["pic"]["size"] > 500000) {
  // echo "Sorry, your file is too large.";
  //  $uploadOk = 0;
//}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $image_error.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error



if(isset($image_error)&&!empty($image_error))
{   
   // echo $image_error."<br/>";
    $errors["image"]=$image_error;


}
?>



