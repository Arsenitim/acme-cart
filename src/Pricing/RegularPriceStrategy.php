<?php

namespace App\Pricing;

use App\Product\Product;

class RegularPriceStrategy implements PriceStrategyInterface
{
    public function calculatePrice(Product $product, int $quantity): float
    {
        return $product->basePrice * $quantity;
    }
}
