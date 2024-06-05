<?php
namespace Controllers;
session_start();
use Controllers\Page;
use Models\Database;
    require_once __DIR__ . '/../models/db.php';
    require_once __DIR__ . '/../controllers/page.php';

$page = new Page();
$page->Header();
class Login{
    protected $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    public function check(){
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        if (empty($login) || empty($password)) {
            echo "Fill in all the fields";
            return;
        }else{
                $this->conn->select_db("data");
                $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
                $n = $this->conn->query($sql);
                if($n->num_rows > 0){
                    $row = $n->fetch_assoc();
                    session_start();
                    $_SESSION['user'] = $row['login'];
                   $_SESSION['message'] = "Welcome, ".$_SESSION['user']."!";
                     header("location:../views/index.php");
                    
                }else{
                    echo "No such user";
                }
               
            }
        }
}
$database = new Database();
$database->open();
$login = new Login($database->conn);
$login->check();
$database->close();
    ?>