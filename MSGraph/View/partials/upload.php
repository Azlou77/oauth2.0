<?php
// Verifications files
if   (!empty($_FILES['attachments']['name']))
{

//Define files's location to be uploaded
$target_dir = "uploads/";

//Define files's format
$target_file = $target_dir . basename($_FILES["attachments"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

// Check file size
if ($_FILES["files"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  } 

// Allow certain file formats
if($imageFileType != "oft" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only oft models outlook files are allowed.";
    $uploadOk = 0;
  }

//  Helps to debug
echo 'Voici quelques informations de débogage :';
print_r($_FILES); 

echo '</pre>';
}
?>