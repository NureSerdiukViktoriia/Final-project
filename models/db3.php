<?php 
namespace Models;
use PDO;
class Db3{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "8135adrpt816wcx_0";
    protected $name = "comments";
    protected $conn;

   public function __construct(){
    try {
        $this->conn = new PDO("mysql:host={$this->servername}", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
   }catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
public function getConnection(){
    return $this->conn;
}
public function open(){
    
  
      //   $this->create();
      
}
   
public function create(){
    try{
    $this->conn->exec("USE {$this->name}");
$this->conn->exec("CREATE TABLE IF NOT EXISTS comments(
 id INT AUTO_INCREMENT PRIMARY KEY,
            user_name VARCHAR(255) NOT NULL,
            comment TEXT NOT NULL
)");
echo "Table created successfully";
}catch (PDOException $e) {
    $this->conn->rollBack();
    echo "Error creating table";
}
}
public function get(){
    try{
        $this->conn->exec("USE {$this->name}");
        $i = $this->conn->query("SELECT * FROM comments");
        $result = $i->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e) {
        $this->conn->rollBack();
    }
}



public function close(){
    $this->conn = null;
}
}
$db3 = new Db3();
$db3->open();
$db3->close();
?>