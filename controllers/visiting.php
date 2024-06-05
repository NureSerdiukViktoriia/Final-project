<?php
namespace Controllers;
use PDO;
class Visiting {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "8135adrpt816wcx_0";
    protected $dbname = "visiting";
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function open() {
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }
}
?>