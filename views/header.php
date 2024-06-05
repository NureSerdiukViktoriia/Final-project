<?php
namespace Views;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
 
</head>
<body>
<header class="header">
      <div class="header-left">
        <img class="icon" src="../img/logo.png" alt="" />
      </div>
      <div class="header-right">
        <nav class="header__menu">
          <ul class="header-menu-list">
            <li>
              <a href="../views/index.php" class="header-menu-link">HOME</a>
            </li>

            <li>
              <a href="../views/aboutus.php" class="header-menu-link">ABOUT US</a>
            </li>

            <li>
              <a href="../controllers/basket.php" class="header-menu-link"
                >BASKET</a
              >
            </li>
            <li>
              <a href="../controllers/authorization.php" class="header-menu-link"
                >AUTHORIZATION</a
              >
            </li>
            <li>
            <?php 
            
    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];
        echo $message;
    }else{
      echo "You are not registred";
    }
    ?><br />
      <form action="../controllers/logout.php" method="post">
              <button class="logout-button">Log out</button>
         
              </form>
            </li>
         
            
 
            
          </ul>
        </nav>

      </div>
    </header>
  