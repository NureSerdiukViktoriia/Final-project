<?php 
namespace Controllers;
class DiscountPriceCalculationStrategy implements PriceCalculationStrategy {
    private $discountPercentage;

    public function __construct($discountPercentage) {
        $this->discountPercentage = $discountPercentage;
    }
    public function calculatePrice($price) {
        return $price * (1 - $this->discountPercentage / 100);
    }
}
?>