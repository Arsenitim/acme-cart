<?php

namespace App\Pricing;

use App\Product\Product;

class BuyOneGetSecondHalfPriceStrategy implements PriceStrategyInterface
{
    public function calculatePrice(Product $product, int $quantity): float
    {
        $pairs = intdiv($quantity, 2);
        $remaining = $quantity % 2;
        return ($pairs * ($product->basePrice * 1.5)) + ($remaining * $product->basePrice);
    }
}
