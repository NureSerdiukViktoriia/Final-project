<?php
namespace Controllers;
// use Models\Db;
use Models\MySqlDatabaseAdapter;
use Models\Db3;
use Controllers\Page;
use PDO;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .total-price{
    margin-left:150px;
}
    </style>
</head>
<body>
    

<?php 
session_start();

require_once __DIR__ . '/../models/db2.php';
require_once __DIR__ . '/../models/db3.php';
require_once __DIR__ . '/../controllers/page.php';

$page = new Page();
$page->Header();
if(isset($_SESSION["user"]) && isset($_SESSION["basket"])) {
    // $db = new Db();
    $db = new \MySqlDatabaseAdapter();
    $conn = $db->getConnection();
    try{
        $conn->query("USE accounts");
        $request = $conn->prepare("INSERT INTO orders (user_name, tour_name, order_price) VALUES (:user_name, :tour_name, :tour_price)");
      
    $user_name = $_SESSION['user'];
    $total_price = 0;
    
    foreach($_SESSION['basket'] as $item) {
        $tour_name = $item['name'];
        $tour_price = $item['price'];
        $total_price += $tour_price;
       
        $request->execute([
            ':user_name' => $user_name,
            ':tour_name' => $tour_name,
            ':tour_price' => $tour_price
        ]);
    }
  ?>
  <div>
    <p class="main-text-confirm">Check and confirm your order:</p>
  </div>
  <?php
   
 } catch(PDOException $e){
echo "Error: " . $e->getMessage();
        }finally{
         
            $db->close();
        }

  

try{
    // $db = new Db();
    $db = new \MySqlDatabaseAdapter();
    $conn = $db->getConnection();
    $conn->query("USE accounts");

    $request = $conn->prepare("SELECT user_name, tour_name, order_price FROM orders WHERE user_name = :user_name");
    $request->execute([':user_name' => $user_name]);
    $orders = $request->fetchAll(PDO::FETCH_ASSOC);
    echo "<h2 class='user-tour'>User: " . htmlspecialchars($user_name) . "</h2>";
    echo "<h3 class='s-tours'>Your Selected Tours:</h3>";
    echo "<div class='list-tours'>";
    echo "<ul>";  
    
    foreach ($orders as $order) {
        echo "<li>" . htmlspecialchars($order['tour_name']) . " - $" . htmlspecialchars($order['order_price']) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
    echo "<h3 class='total-price'>Total Price: $" . htmlspecialchars($total_price) . "</h3>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
  //  unset($_SESSION["basket"]);
    $db->close();

}
}else{
    ?>
    <div>
        <p class="selected-tours">You have no selected tours. Select tours or register</p>
    </div>
    <?php
}



?>
<form action="" method="post">
    <input type="hidden" name="user_name" value='<?php echo htmlspecialchars($user_name); ?>'>
    <button type="submit" name="delete_tours" class="delete-tours-button">Delete All Tours</button>
    <?php unset($_SESSION["basket"]);?>
</form>




<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_tours'])) {
    try {
        // $db = new Db();
        $db = new \MySqlDatabaseAdapter();
        $conn = $db->getConnection();
        $conn->query("USE accounts");

        $user_name = $_POST['user_name'];
        $request = $conn->prepare("DELETE FROM orders WHERE user_name = :user_name");
        $request->execute([':user_name' => $user_name]);
         
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $db->close();
    }
}
$page->Footer();
?>




</body>
</html>