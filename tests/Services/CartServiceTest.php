<?php

namespace Tests\Services;

use App\Exceptions\ProductNotFoundException;
use App\Seeders\ProductCatalogueSeederExperiment;
use App\Seeders\ProductCatalogueSeederRegular;
use App\Services\ShippingCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Services\CartService;
use PHPUnit\Framework\TestCase;

class CartServiceTest extends TestCase
{
    public static function productSetRegularProvider(): array
    {
        return [
            [
                'productsQuantities' => [
                    'B01' => 1,
                    'G01' => 1
                ],
                'expectedTotal' => 37.85
            ],
            [
                'productsQuantities' => [
                    'R01' => 2
                ],
                'expectedTotal' => 68.85
            ],
            [
                'productsQuantities' => [
                    'R01' => 1,
                    'G01' => 1
                ],
                'expectedTotal' => 60.85
            ],
            [
                'productsQuantities' => [
                    'B01' => 2,
                    'R01' => 3
                ],
                'expectedTotal' => 114.75 // Free shipping
            ],
        ];
    }

    public static function productSetExperimentProvider(): array
    {
        return [
            [
                'productsQuantities' => [
                    'B01' => 1,
                    'G01' => 1
                ],
                'expectedTotal' => 37.85
            ],
            [
                'productsQuantities' => [
                    'R01' => 2
                ],
                'expectedTotal' => 54.38
            ],
            [
                'productsQuantities' => [
                    'R01' => 1,
                    'G01' => 1
                ],
                'expectedTotal' => 60.85
            ],
            [
                'productsQuantities' => [
                    'B01' => 2,
                    'R01' => 3
                ],
                'expectedTotal' => 98.28
            ],
        ];
    }

    #[DataProvider('productSetRegularProvider')]
    public function testCartCalculatesRegularTotalCorrectly(array $productsQuantities, float $expectedTotal): void
    {
        $cart = new CartService(new ProductCatalogueSeederRegular(), new ShippingCalculator());

        foreach ($productsQuantities as $productCode => $productsQuantity) {
            $cart->addProduct($productCode, $productsQuantity);
        }

        $this->assertEquals($expectedTotal, $cart->calculateTotalWithShipping());
    }

    #[DataProvider('productSetExperimentProvider')]
    public function testCartCalculatesExperimentTotalCorrectly(array $productsQuantities, float $expectedTotal): void
    {
        $cart = new CartService(new ProductCatalogueSeederExperiment(), new ShippingCalculator());

        foreach ($productsQuantities as $productCode => $productsQuantity) {
            $cart->addProduct($productCode, $productsQuantity);
        }

        $this->assertEquals($expectedTotal, $cart->calculateTotalWithShipping());
    }

    public function testProductNotFoundException(): void
    {
        $cart = new CartService(new ProductCatalogueSeederRegular(), new ShippingCalculator());

        $this->expectException(ProductNotFoundException::class);

        $cart->addProduct('BAD_CODE', 1);
    }
}
