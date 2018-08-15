<?php
session_start();

if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: http://localhost/PHP-project/PHP-project/login.php');
        exit;
}

if (!isset($_SESSION['ar prisijunge']) || !$_SESSION['ar prisijunge'] === true) {

        header('Location: http://localhost/PHP-project/PHP-project/login.php');
        exit;
}
?>
<!DOCTYPE html5>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <title>File manager</title>
</head>
<body>
<div class="heading1">
<h1 id="manager">File Manager<span id="version"> v0.1</span></h1>
</div>
<?php
$current = '';


if(empty($_GET)) {
$dir = '.';
} else {
$dir = $_GET['dir-name'];
}
// else if(isset($_GET['dir-name'])) {
// $_GET['dir-name'];
// }


//DIR

if(isset($_GET['up-dir'])) {
        echo $_GET['dir-name'];
        $dir = preg_replace('/\w+\/\w*$/', '', $_GET['dir-name']);
} 

if(isset($_POST['file-name'])) {
   $file = $_POST['file-name'];
}
elseif(isset($_GET['file-name'])) {
   $file = $_GET['file-name'];
}
else {
   $file = '';
}

if(isset($_POST['extension'])) {
   $ext= $_POST['extension'];
}
elseif(isset($_GET['extension'])) {
   $ext = $_GET['extension'];
}
else {
   $ext = '';
} 


if(isset($_POST['create-new-file']) && $_POST['new-file-name'] != '') {
   fopen($dir .$_POST['new-file-name']. '.txt', "w");
   $file = $_POST['new-file-name'] . $ext;
}

if(isset($_POST['save'])) {
   $edit_text = $_POST['editor'];
   file_put_contents(str_replace('.', '',  $dir) .$file, $edit_text. "\n");
}


if($file) {
   @$current = file_get_contents($dir .$file);
}

if(isset($_POST['delete-file'])) {
   @unlink($dir .$file);
   $current = '';
}

if (isset($_POST['submit'])) {
        include 'uploadFile.php';
}

?>
<!-- Atidaro php ir iskart echo, siuo atveju $file  -->
<h3 id="currentFile"><?= $file ?><?php if(isset($_POST['delete-file'])) echo ' file deleted' ?></h3>
<div id="form">

<form action="index1.php" method="POST" enctype="multipart/form-data">
<?php if($ext == 'txt' || $ext == ''):?>
<textarea file-name="<?php $_GET['file-name'] ?>" style="width: 500px; height: 250px" name="editor" id="" cols="30" rows="10"><?php echo $current ?></textarea>
<?php endif; ?>
<?php if($ext == 'jpg'):?>
<img style="width: 500px; height: 250px; border-radius: 5px; box-shadow: 0 0 20px black;" src="files/<?= $file ?>" alt="">
<?php endif; ?>
<br>
<div class="buttons1">
<input id="file-name" type="text" name="new-file-name" file-name="<?php $_GET['file-name'] ?>" placeholder="File name" value="">
<input class="button" type="submit" name="create-new-file" file-name="<?php $_GET['file-name'] ?>" value="New file">
<input id="delete-file" type="submit" name="delete-file" file-name="<?php $_GET['file-name'] ?>" value="Delete file">
</div>
<div class="buttons2">
<input type="file" name="fileToUpload" id="fileToUpload">
<label for="fileToUpload" >Choose file to upload</label>
<input id="uploadImage" type="submit" value="Upload Image" name="submit">
<input id="save-file" class="button" type="submit" name="save" file-name="<?php $_GET['file-name'] ?>" value="Save">
<input type="hidden" name="file-name" value="<?=$dir. $file ?>">
<input type="hidden" name="extension" value="<?= $ext ?>">
<input type="submit" name="logout" id="logout" value="Logout">
</div>
</form>
<?php  
        if ($handle = opendir($dir)) {
                echo '<div class="dir">';
                // arba $_GET['dir-name']
                echo '<a href="?type=text&up-dir=true&dir-name=' .$dir. '"><b>◄ BACK TO ROOT</b></a><br>';
                while (false !== ($entry = readdir($handle))) {
                        if (preg_match('/\.(txt|jpg)$/', $entry, $mas)) {
                             echo '<a href="?type=text&dir-name=' .$dir. '&file-name=' .$entry. '&extension=' .$mas[1]. '">' .$entry. '</a><br>';
                        } else if(!preg_match('/((\.\w+)|(\.+))$/', $entry)) {
                             echo '<a href="?type=text&dir-name=' .str_replace('.', '', $dir)  .$entry. '/">' .$entry. '/</a><br>';
                        }
                        
                }
                closedir($handle);
                echo '</div>';     
        }
        echo $dir;
?>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="js/script.js"></script> -->
</body>
</html>