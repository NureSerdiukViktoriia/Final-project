<?php 
namespace Controllers;
session_start();
if(isset($_GET['delete'])){
    $delete = $_GET['delete'];
    if(isset($_SESSION['basket'][$delete])){
        unset($_SESSION['basket'][$delete]);
    }
}
header("Location: ../controllers/basket.php");
?>