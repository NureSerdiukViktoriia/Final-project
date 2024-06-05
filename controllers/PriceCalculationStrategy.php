<?php
namespace Controllers;

interface PriceCalculationStrategy {
    public function calculatePrice($price);
}

?>