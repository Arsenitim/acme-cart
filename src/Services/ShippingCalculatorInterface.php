<?php

namespace App\Services;

interface ShippingCalculatorInterface
{
    public function calculateShipping(float $subtotal): float;
}
