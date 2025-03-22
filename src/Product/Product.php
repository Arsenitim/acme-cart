<?php

namespace App\Product;

use App\Pricing\PriceStrategyInterface;

class Product
{
    public string $code;
    public string $name;
    public float $basePrice;
    private PriceStrategyInterface $pricingStrategy;

    public function __construct(string $code, string $name, float $basePrice, PriceStrategyInterface $pricingStrategy)
    {
        $this->code = $code;
        $this->name = $name;
        $this->basePrice = $basePrice;
        $this->pricingStrategy = $pricingStrategy;
    }

    public function calculateTotal(int $quantity): float
    {
        return $this->pricingStrategy->calculatePrice($this, $quantity);
    }
}
