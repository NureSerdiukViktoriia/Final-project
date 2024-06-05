<?php 
abstract class NewAdapter implements DatabaseAdapter{
    protected $conn;
    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function close() {
        $this->conn = null;
    }
}
interface DatabaseAdapter {
    public function getConnection();
    public function createDatabase($name);
    public function useDatabase($name);
    public function createTable($name, $columns);
    public function close();
}
class MySqlDatabaseAdapter extends NewAdapter {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "8135adrpt816wcx_0";
    protected $conn;

  
    public function createDatabase($name) {
        try {
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS {$name}");
        } catch (PDOException $e) {
            echo "Error creating database";
        }
    }
    public function useDatabase($name) {
        try {
            $this->conn->exec("USE {$name}");
        } catch (PDOException $e) {
            echo "Error selecting database";
        }
    }
    public function createTable($name, $columns) {
        try {
            $this->conn->exec("CREATE TABLE IF NOT EXISTS {$name} ({$columns})");
        } catch (PDOException $e) {
            echo "Error creating table";
        }
    }
  
}
$adapter = new MySqlDatabaseAdapter();
$adapter->getConnection();
// $adapter->createDatabase("accounts");
$adapter->useDatabase("accounts");
//$adapter->createTable("orders", "id INT AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(50) NOT NULL, tour_name VARCHAR(255) NOT NULL, order_price DECIMAL(10,2) NOT NULL");
$adapter->close();



?>