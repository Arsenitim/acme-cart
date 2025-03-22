<?php

namespace Tests\Services;

use App\Services\ShippingCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ShippingCalculatorTest extends TestCase
{
    public static function shippingTestDataProvider(): array
    {
        return [
            [
                'subTotal' => 10.00,
                'expectedShippingCost' => 4.95
            ],
            [
                'subTotal' => 60.00,
                'expectedShippingCost' => 2.95
            ],
            [
                'subTotal' => 110,
                'expectedShippingCost' => 0
            ]
        ];
    }


    #[DataProvider('shippingTestDataProvider')]
    public function testShippingCalculatedCorrectly(float $subTotal, float $expectedShippingCost): void
    {
        $shippingCalculator = new ShippingCalculator();

        $this->assertEquals($expectedShippingCost, $shippingCalculator->calculateShipping($subTotal));
    }
}
