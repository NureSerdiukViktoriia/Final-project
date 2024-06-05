<?php 
namespace Controllers;
session_start();
if(isset($_POST["add"])){
    $_SESSION['basket'][] = array(
        'user' => $_POST['user'],
        'name' => $_POST['tour_name'],
        'price' => $_POST['tour_price'],
    );
}
header("Location: ../controllers/basket.php");
?> 