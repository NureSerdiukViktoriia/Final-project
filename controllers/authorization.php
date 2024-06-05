<?php 
namespace Controllers;
session_start();
use Models\Database;
require_once __DIR__ . '/../controllers/register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.reset-password{
  text-align:center;
  color:#256BD4;
  margin-top:10px;
}
    </style>
</head>
<body>

<div class="forms">
<form action="../controllers/register.php" method="post">
<input type="text" placeholder="login" name="login"> 
<input type="password" placeholder="password" name="password"> 
<input type="password" placeholder="repeat password" name="repeatpass"> 
<input type="text" placeholder="email" name="email"> 
<button type="submit" class="button-tour button1">Register</button>
</form>

<form action="../controllers/login.php" method="post">
<input type="text" placeholder="login" name="login"> 
<input type="password" placeholder="password" name="password"> 
<button type="submit" class="button-tour button1">Log in</button>
</form>
</div>
<a class="reset-password" href="../controllers/resetPassword.php">Forgot your password?</a>

<?php 
require_once __DIR__ . '/../models/db.php';

$database = new Database();
$database->open();
$register = new Register($database->conn);
$array = $register->find();
// $register->input($array);
   $database->close();
//    require_once"information.php";
// require_once __DIR__ . '/../controllers/processor.php';
?>


</body>
</html>