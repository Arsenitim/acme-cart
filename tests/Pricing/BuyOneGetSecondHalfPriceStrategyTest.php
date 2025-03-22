<?php

namespace Tests\Pricing;

use App\Pricing\PriceStrategy;
use App\Pricing\PriceStrategyFactory;
use PHPUnit\Framework\TestCase;
use App\Product\Product;

class BuyOneGetSecondHalfPriceStrategyTest extends TestCase
{
    public function testBuyOneGetSecondHalfPriceEvenQuantity(): void
    {
        $strategy = PriceStrategyFactory::create(PriceStrategy::BUY_ONE_GET_SECOND_HALF_PRICE);
        $product = new Product(
            'P2',
            'Discounted Product',
            20.0,
            $strategy
        );

        $total = $strategy->calculatePrice($product, 4); // 2 full + 2 half = 60
        $this->assertEquals(60.0, $total);
    }

    public function testBuyOneGetSecondHalfPriceOddQuantity(): void
    {
        $strategy = PriceStrategyFactory::create(PriceStrategy::BUY_ONE_GET_SECOND_HALF_PRICE);
        $product = new Product('P2', 'Discounted Product', 20.0, $strategy);

        $total = $strategy->calculatePrice($product, 5); // 2 full + 2 half + 1 full = 80
        $this->assertEquals(80.0, $total);
    }
}
