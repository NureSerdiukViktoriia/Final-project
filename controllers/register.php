<?php
namespace Controllers;
use Controllers\Page;
use Models\Database;
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../controllers/page.php';

    $page = new Page();
    $page->Header();
    echo "<link rel='stylesheet' href='../css/style.css'>";
    class Register{
       
        protected $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

public function checkUser($login, $email){
    $this->conn->select_db("data");
    $sql = "SELECT * FROM users WHERE login = '$login' OR email = '$email'";
    $result = $this->conn->query($sql);
    if (!$result) {
        throw new Exception("Error: " . $this->conn->error);
    }
    return $result->num_rows > 0;
}

        public function add(){
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $repeatpass = isset($_POST['repeatpass']) ? $_POST['repeatpass'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
      
       
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)){
                echo "You entered your email incorrectly";
            }
            else if(!preg_match("/^[a-zA-Z0-9_]{1,15}$/", $login)){
                echo "You entered your login incorrectly";
            }
       else if (empty($login) || empty($password) || empty($repeatpass) || empty($email)) {
            echo "Fill in all the fields";
            return;
        }else{
            if ($password !== $repeatpass) {
                echo "Password mismatch";
                return;
            } else if($this->checkUser($login, $email)){
echo "A person with this login already exists";
return;
            }
            else{
                $this->conn->select_db("data");
                $sql = "INSERT INTO users (login, password, email) VALUES ('$login', '$password', '$email')";
                $result = $this->conn->query($sql);
                if(!$result){
                    throw new Exception("Error: " . $this->conn->error);
                }
                if($result === TRUE){
    echo "New user added";
                }else{
                    echo "User was not added";
                }
            }
        
        }
    }
        }

        public function delete($login, $password){
            $this->conn->select_db("data");
            $sql = "DELETE FROM users WHERE login = '$login' AND password = '$password'";
            $result = $this->conn->query($sql);
            if(!$result){
                throw new Exception("Error: " . $this->conn->error);
            }
        }
            


        public function find(){
          
            $this->conn->select_db("data");
            $sql = "SELECT * FROM users";
            $n = $this->conn->query($sql);
            if(!$n){
                throw new Exception("Error: " . $this->conn->error);
            }
            $array = array();
            if($n->num_rows > 0){
                while($row = $n->fetch_assoc()){
                    $array[] = $row;
                }
            }
            return $array;
        }

        public function input($array){
            echo "<table class='t'>";
            echo "<tr><td>Login</td><td>Password</td><td></td></tr>";
            foreach($array as $row){
                echo "<tr><td>" . $row['login']. "</td><td>".$row['password']."</td><td><form method='post'><input type='hidden' name='login' value='".$row['login']."'><input type='hidden' name='password' value='".$row['password']."'><input type='submit' name='delete' value='Delete' class='button-tour button2'></form></td></tr>";
            }
            echo "</table>";
           }
    }
    $database = new Database();
    $database->open();
    $register = new Register($database->conn);
    $register->add();
    $array = $register->find();
    
if(isset($_POST['delete'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $register->delete($login, $password);
    $array = $register->find();
    header("Location: ../controllers/authorization.php");
}
$database->close();

    ?>