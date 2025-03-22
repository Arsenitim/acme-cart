<?php

namespace Tests\Pricing;

use App\Pricing\PriceStrategy;
use App\Pricing\PriceStrategyFactory;
use PHPUnit\Framework\TestCase;
use App\Product\Product;

class RegularPriceStrategyTest extends TestCase
{
    public function testCalculatesRegularPriceCorrectly(): void
    {
        $strategy = PriceStrategyFactory::create(PriceStrategy::REGULAR);
        $product = new Product('P1', 'Test Product', 10.0, $strategy);

        $total = $product->calculateTotal(10); // 10x10=100
        $this->assertEquals(100.0, $total);
    }

    public function testBuyOneGetSecondHalfPrice(): void
    {
        $strategy = PriceStrategyFactory::create(PriceStrategy::BUY_ONE_GET_SECOND_HALF_PRICE);
        $product = new Product('P1', 'Test Product', 17.0, $strategy);

        $total = $product->calculateTotal(5); // 17+8.5+17+8.5+17=68
        $this->assertEquals(68.0, $total);
    }
}
