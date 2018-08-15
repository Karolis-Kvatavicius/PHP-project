<?php
$target_dir = "files/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     @$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "<h3>File is an image - " . $check["mime"] . ".</h3>";
//         $uploadOk = 1;
//     } else {
//         echo "<h3>File is not an image.</h3>";
//         $uploadOk = 0;
//     }
// }

// Check if file already exists
if (file_exists($target_file)) {
    echo "<h3>Sorry, file already exists.</h3>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<h3>Sorry, your file is too large.</h3>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "txt" ) {
    echo "<h3>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h3>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h3>Sorry, your file was not uploaded.</h3>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<h3>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h3>";
    } else {
        echo "<h3>Sorry, there was an error uploading your file.</h3>";
    }
}
?>