<?php

namespace App\Pricing;

class PriceStrategyFactory
{
    public static function create(PriceStrategy $priceStrategy): PriceStrategyInterface
    {
        return match ($priceStrategy) {
            PriceStrategy::REGULAR => new RegularPriceStrategy(),
            PriceStrategy::BUY_ONE_GET_SECOND_HALF_PRICE => new BuyOneGetSecondHalfPriceStrategy()
        };
    }
}
