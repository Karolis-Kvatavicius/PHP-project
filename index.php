<?php
$file = 'text.txt';
$edit_text = $_POST['editor'];
file_put_contents($file, $edit_text);
?>
<form action="index.php" method="POST">
<textarea name="input-text" id="" cols="30" rows="10"></textarea>
<input type="submit" value="save">
</form>