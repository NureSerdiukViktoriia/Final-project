<?php 
namespace Controllers;
use Controllers\Page;
use Models\Database;
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../controllers/page.php';
$page = new Page();
$page->Header();
class ResetPassword {
    protected $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function updatePassword() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $login = isset($_POST['login']) ? $_POST['login'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $repeatpass = isset($_POST['repeatpass']) ? $_POST['repeatpass'] : '';
            if (empty($login) || empty($password) || empty($repeatpass)) {
                echo "Fill in all the fields";
                return;
            }
            if ($password !== $repeatpass) {
                echo "Passwords do not match";
                return;
            }
            $this->conn->select_db("data");
            $sql_check = "SELECT * FROM users WHERE login = '$login'";
            $result_check = $this->conn->query($sql_check);
            if ($result_check->num_rows === 0) {
                echo "User not found";
                return;
            }
         
            $sql = "UPDATE users SET password = '$password' WHERE login = '$login'";
            $result = $this->conn->query($sql);
            if ($result === TRUE) {
                ?>
                <div><p class="updated-pass">Password updated successfully</p></div>
                <?php
            } else {
                echo "Failed to update password";
            }
        }
    }
}
$database = new Database();
$database->open();
$resetPassword = new ResetPassword($database->conn);
$resetPassword->updatePassword();
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .button-tour3{
  margin: 0 auto;
  display: block;
  font-size: 14px;
  box-shadow: 0 6px 40px rgba(128, 183, 179, 0.54);
  text-transform: uppercase;
  border-radius: 10px;
  text-decoration: none;
  height: 44px;
  width: 180px;
  color: #ffffff;
  background-color: #3984f3;
  border: 1px solid #1a71f3;
}

.button-tour3:hover {
  background: #3984c4;
}
.button-tour3:active {
  background: #398494;
}
.updated-pass{
   text-align:center;
   margin-top:30px;
}
    </style>
</head>
<body>

<div class="forms">
<form action=""method="post">
<input type="text" placeholder="login" name="login"> 
<input type="password" placeholder="password" name="password"> 
<input type="password" placeholder="repeat password" name="repeatpass"> 
<button type="submit" class="button-tour3 button3">Update password</button>
</form>
</div>
</body>
</html>

