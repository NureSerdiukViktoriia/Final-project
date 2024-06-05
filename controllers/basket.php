<?php
namespace Controllers;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
</head>
<body>
    
<?php 
session_start();
echo "<link rel='stylesheet' href='../css/style.css'>";
require_once __DIR__ . '/../controllers/page.php';
use Controllers\Page;
$page = new Page();
$page->Header();
?>

<div class="basket-content">
    <div class="basket-first-text">
<p>Thank you for choosing our travel package!</br></div>
<p>If you have any questions or requests regarding your trip, please do not hesitate to <a href="https://www.instagram.com/rheojourneys/">contact us</a>.</br> We are always ready to help you make your trip as pleasant and unforgettable as possible.</p>
</div>
<div class="your-tours">
    <h3>Your basket:</h3>
</div>

<?php 
if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])){
    foreach($_SESSION['basket'] as $delete => $tour){
        echo "<div class='basket-item'><span>Name:</span> " . $tour['name'] . "</br> <span>Price: </span>" . $tour['price'] . "<a href='../controllers/deleteInf.php?delete=$delete'><img src='../img/icons8-удалить-48.png' alt='Delete'></a></div><br>";



    }
    }else{
       
        echo "<a href='../views/index.php' class='basket-item basket-tour'><span class='basket-tour'>Go to tours</span></a>";

}
?>
<form action="../controllers/orders.php" method="post">
    <button type="submit" name="order_now" class="button-order-tour">Order selected tours</button>
   
    <?php
    if(isset($_SESSION['basket'])){
    foreach ($_SESSION['basket'] as $tour) {
        echo '<input type="hidden" name="tour_name[]" value="' . $tour['name'] . '">';
        echo '<input type="hidden" name="tour_price[]" value="' . $tour['price'] . '">';
    }
}
    ?>
</form>
<?php 

require_once __DIR__ . '/../controllers/comment.php';
$page->Footer();
?>
</body>
</html>