<?php
namespace Views;
session_start();

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
  
<?php 

use Controllers\Page;
use Controllers\Tour;
use Models\Db3;
use Controllers\Factory;
use Controllers\DiscountPriceCalculationStrategy;




echo "<link rel='stylesheet' href='../css/style.css'>";

require_once __DIR__ . '/../controllers/Page.php';
require_once __DIR__ . '/../models/Db3.php';
require_once __DIR__ . '/../controllers/PriceCalculationStrategy.php';
require_once __DIR__ . '/../controllers/DiscountPriceCalculationStrategy.php';



$page = new Page();
$page->Header();
?>
 <main>
      <div class="section1">
        <section class="section-first">
          <div class="section-first-h">
            <h1 class="section-first-h1">
              Travel around <br />
              the world
            </h1>
          </div>
          <div class="section-first-p">
            <p class="section-first-p1">
              Plan and book your perfect trip with expert advice, <br />
              travel tips, destination information and <br />
              inspiration from us.
            </p>
          </div>
          <div class="section-second">
            <div class="section-second-button">
              <a href="#footer" class="section-second-button1"
                ><span>Contact Us</span></a
              >
            </div>
          </div>
        </section>

        <section class="section-third">
          <img class="section-third-img" src="../img/9372532.jpg" alt="" />
        </section>
        </div>

    </main>
    <section>
      <div class="tour-information">
      <div class="tour-text">
        <p class = "span-text"><span>Welcome to our travel agency,</span></br></br> where we're ready to provide you with the best journeys around the world,</br> regardless of your budget and preferences. Choose your next unforgettable getaway with us!</p>
      </div>
        <div class="tour-content">
        
    <?php 

    require_once __DIR__ . '/../controllers/Tour.php';
    $tourFactory = new Factory();
    $tour1 = $tourFactory->createTour("Discover Thailand", "Relax on the white sandy beaches of Phuket and enjoy the atmosphere of Bangkok, transformed into nightlife.", "10 days", 1800, "../img/thailand.jpg", new DiscountPriceCalculationStrategy(10));
    $tour2 = $tourFactory->createTour("Australian Adventure", "Embark on an exciting journey to Sydney and Kangaroo Island, where unforgettable experiences and adventures await you.", "12 days", 3000, "../img/sydney-opera-house-354375_1280.jpg", new DiscountPriceCalculationStrategy(10));
    $tour3 = $tourFactory->createTour("Explore Italy", "Immerse yourself in the embrace of Italian culture, savoring the tastiest pasta and enjoying captivating landmarks.", "10 days", 1500, "../img/italy.jpg", new DiscountPriceCalculationStrategy(10));
    $tour4 = clone $tour3;
    $tour5 = $tourFactory->createTour ("Explore Japan", "Dive into the futuristic culture of Japan, where modernity meets tradition, visiting Tokyo and Kyoto.","14 days", "2500", "../img/japan.jpg", new DiscountPriceCalculationStrategy(10));
    $tour6 = $tourFactory->createTour ("Visit Paris", "Discover the magic of Paris, strolling through the streets of the City of Light and enjoying views of the Eiffel Tower.","7 days", "2000", "../img/paris-6803796_1280.jpg", new DiscountPriceCalculationStrategy(10));
    $tour7 = $tourFactory->createTour ("Greek Adventure", "Embark on a journey through the ancient wonders of Greece, exploring historic sites and indulging in delicious Mediterranean cuisine.","9 days", "1700", "../img/santorini-416136_1280.jpg", new DiscountPriceCalculationStrategy(10));
    
    $tour1->getInfo();
    $tour2->getInfo();
    $tour3->getInfo();

    $tour5->getInfo();
    $tour6->getInfo();
    $tour7->getInfo();

    // $superTour = new SuperTour ("Spain", "Lorem","2 month", "200$", "https://media.licdn.com/dms/image/C5612AQEOduMZUBmMeQ/article-cover_image-shrink_600_2000/0/1520043376366?e=2147483647&v=beta&t=NKeRSrgW7qljxjBZnCfsj565vUIFOD7uGA0q8v_CHOs", 5);
    // $superTour->getInfo();
    ?>
    </div>
    </div>
</section>
<section>
  <?php
  $db3 = new Db3();
  $result = $db3->get();
  if ($result) {
    echo "<h2 class='comments'>Comments: </h2>";
    echo "<div class='u-comment'>";
    echo "<ul>";
    foreach ($result as $comment) {
      echo "<div class='each-comment'>";
        echo "<li class='users-li'><strong>User:</strong> " . htmlspecialchars($comment['user_name']) . "<br>";
        echo "<strong>Comment:</strong> " . htmlspecialchars($comment['comment']) . "</li>";
        echo"</div>";
        echo"<br />";
      }
    
    echo "</ul>";
    echo"</div>";
  } else {
    ?>
    <div class="find-comments">No comments found.</div>
    <?php
  }
  ?>
</section>



<?php 
    require_once __DIR__ . '/../controllers/amountOfVisitors.php';
$page->Footer();
?>



</body>
</html>