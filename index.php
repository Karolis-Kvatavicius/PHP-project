<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>File manager</title>
</head>
<body>
<h1>File Manager<span id="version"> v0.1</span></h1>
<?php
$current = '';
$file = 'files/text.txt';

if(isset($_POST['create-new-file']) && $_POST['new-file-name'] != '') {
    fopen('files/' .$_POST['new-file-name']. '.txt', "w");
}

if(isset($_GET['file-name'])) {
    $file = 'files/' .$_GET['file-name'];
    $current = file_get_contents($file);
}

if(isset($_POST['save'])) {
$edit_text = $_POST['editor'];
file_put_contents($file, $edit_text. "\n", FILE_APPEND | LOCK_EX);
}

if(isset($_POST['edit'])) {
$current = file_get_contents($file);
}

if(isset($_POST['confirm-edit'])) {
    $edit_text = $_POST['editor'];
    file_put_contents($file, $edit_text. "\n", LOCK_EX);
}

if(isset($_POST['delete-file'])) {
    @unlink($file);
}

?>
<div id="form">
<form action="index.php" method="POST">
<textarea file-name="<?php $_GET['file-name'] ?>" style="width: 500px; height: 250px" name="editor" id="" cols="30" rows="10"><?php echo $current ?></textarea>
<br>
<div class="buttons1">
<input id="file-name" type="text" name="new-file-name" file-name="<?php $_GET['file-name'] ?>" placeholder="File name" value="">
<input class="button" type="submit" name="create-new-file" file-name="<?php $_GET['file-name'] ?>" value="New file">
<input id="delete-file" type="submit" name="delete-file" file-name="<?php $_GET['file-name'] ?>" value="Delete file">
</div>
<div class="buttons2">
<input class="button" type="submit" name="save" file-name="<?php $_GET['file-name'] ?>" value="Save">
<input class="button" type="submit" name="edit" file-name="<?php $_GET['file-name'] ?>" value="Edit">
<input class="button" type="submit" name="confirm-edit" file-name="<?php $_GET['file-name'] ?>" value="Confirm edit">
</div>
</form>
<?php
if ($handle = opendir('files/')) {
    echo '<div class="dir">';
    while (false !== ($entry = readdir($handle))) {
            // echo '<a href="#">' .$entry. '</a><br>';
            echo '<a href="?type=text&file-name=' .$entry. '">' .$entry. '</a><br>';
    }
    closedir($handle);
    echo '</div>';
 }
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>