<?php 
namespace Controllers;

interface TourFactory {
    public function createTour($name, $description, $duration, $price, $image, $priceCalculationStrategy);
}
class Factory implements TourFactory {
    public function createTour($name, $description, $duration, $price, $image, $priceCalculationStrategy) {
        return new Tour($name, $description, $duration, $price, $image, $priceCalculationStrategy);
    }
}


class Tour{
protected $name;
protected $description;
protected $duration;
protected $price;
protected $image;
protected $priceCalculationStrategy;

public function __construct($name, $description, $duration, $price, $image, PriceCalculationStrategy $priceCalculationStrategy){
    $this->name = $name;
    $this->description = $description;
    $this->duration = $duration;
    $this->price = $price;
    $this->image = $image;
    $this->priceCalculationStrategy = $priceCalculationStrategy;
}

public function getInfo(){
    $discountedPrice = $this->priceCalculationStrategy->calculatePrice($this->price);
    echo '<div class="tour">';
    echo '<img class="tour-image" src="' . $this->image . '" alt="' . $this->name . '">';
    echo '<h2 class="tour-name">' . $this->name . '</h2>';
    echo '<p class="tour-description">' . $this->description . '</p>';
    echo '<p class="tour-duration"><span>Duration:</span> ' . $this->duration . '</p>';
    echo '<p class="tour-price"><span>Price:</span> ' . $this->price . '</p>';
    echo '<p class="tour-price"><span>Discounted price:</span> ' . $discountedPrice . '</p>';
    echo '<form method="post" action="../controllers/saveInf.php">';
    echo '<input type="hidden" name="tour_name" value="' . $this->name . '">';
    echo '<input type="hidden" name="tour_price" value="' . $discountedPrice . '">';
    echo '<button type="submit" class="button-tour" name="add">Add to Basket</button>';
    echo '</form>';
    echo '</div>';
}

public function __clone(){
    $this->name = "Tour";
    $this->description = "Tour description";
    $this->duration = "1 day";
    $this->price = "2000";
    $this->image = "img/4054617.png";
}

}

?>





<!-- // class SuperTour extends Tour{
//     protected $rating;
//     public function __construct($name, $description, $duration, $price, $image, $rating){
//         parent::__construct($name, $description, $duration, $price, $image);
//         $this->rating = $rating;
    
// }
//     public function getInfo(){
//         parent::getInfo();
//         echo "Rating: " . $this->rating . "<br>";
//     }

// } -->