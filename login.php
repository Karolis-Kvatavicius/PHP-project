<?php
session_start();
?>
<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login</title>
</head>
<body>

<?php
$email = 'vardas@pastas.lt';
$password = '123';

if(isset($_POST['enter_password']) && $_POST['user_name'] == $email
 && $_POST['password'] == $password) {
    $_SESSION['ar prisijunge'] = true;
    header('Location: http://localhost/PHP-project/PHP-project/index1.php');
    exit;

} else {
    if (empty($_POST)) {
?>

<h1>Please login</h1>
<form id="login-form" action="login.php" method="POST">
<div>
<p class="login-p">User name:</p><br>
<input class="login" type="text" name="user_name"><br>
<p class="login-p">Password:</p><br>
<input class="login" type="password" name="password"><br>
<input class="login" type="submit" name='enter_password' value="Login"><br>
</div>
</form>

<?php
} else {
?>

<h1>Please login</h1>
<form action="login.php" method="POST">
User name: <br>
<input class="login" type="text" name="user_name"><br>
Password: <br>
<input class="login" type="password" name="password"><br>
<input class="login" type="submit" name='enter_password' value="login"><br>
</form>
<h2>Klaidingas vartotojo vardas arba slaptažodis</h2>

<?php
}
}
?>
</body>
</html>

