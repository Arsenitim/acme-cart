<?php

namespace App\Services;

class ShippingCalculator implements ShippingCalculatorInterface
{
    // TODO: We should obviously use Database here.
    // But for the sake of this exercise - I'll just use hard-coded settings
    private const float FREE_SHIPPING_THRESHOLD = 90.00;
    private const float REDUCED_RATE_THRESHOLD = 50.00;
    private const float REDUCED_RATE = 2.95;
    private const float BASE_RATE = 4.95;

    public function calculateShipping(float $subtotal): float
    {
        if ($subtotal >= self::FREE_SHIPPING_THRESHOLD) {
            return 0.00;
        }

        if ($subtotal >= self::REDUCED_RATE_THRESHOLD) {
            return self::REDUCED_RATE;
        }

        return self::BASE_RATE;
    }
}
