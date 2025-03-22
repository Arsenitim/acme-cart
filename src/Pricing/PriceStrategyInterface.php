<?php

namespace App\Pricing;

use App\Product\Product;

interface PriceStrategyInterface
{
    public function calculatePrice(Product $product, int $quantity): float;
}
