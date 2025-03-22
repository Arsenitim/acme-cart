<?php

namespace App\Services;

use App\Exceptions\ProductNotFoundException;
use App\Seeders\ProductCatalogSeederInterface;

class CartService
{
    private array $items = [];
    private array $productCatalogue;

    public function __construct(
        private readonly ProductCatalogSeederInterface $productCatalogSeeder,
        private readonly ShippingCalculatorInterface $shippingCalculator
    ) {
        $this->productCatalogue = $this->productCatalogSeeder->seed();
    }

    public function addProduct(string $productCode, int $quantity): void
    {
        if (isset($this->items[$productCode])) {
            $this->items[$productCode]['quantity'] += $quantity;
        } else {
            // TODO: Move productCatalogue into its own class
            if (!isset($this->productCatalogue[$productCode])) {
                throw new ProductNotFoundException($productCode);
            }
            $product = $this->productCatalogue[$productCode];
            $this->items[$product->code] = ['product' => $product, 'quantity' => $quantity];
        }
    }

    public function calculateSubTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['product']->calculateTotal($item['quantity']);
        }
        return $total;
    }

    public function calculateTotalWithShipping(): float
    {
        $subtotal = $this->calculateSubTotal();
        $total = $subtotal + $this->shippingCalculator->calculateShipping($subtotal);
        return round($total, 2);
    }

    public function calculateShipping(): float
    {
        $subtotal = $this->calculateSubTotal();
        $shipping = $this->shippingCalculator->calculateShipping($subtotal);
        return round($shipping, 2);
    }

    public function getCartSummary(): string
    {
        $summary = "";
        foreach ($this->items as $item) {
            $summary .= "{$item['product']->name} x {$item['quantity']} = $" .
                number_format($item['product']->calculateTotal($item['quantity']), 2) . PHP_EOL;
        }
        $summary .= "Subtotal: $" . number_format($this->calculateSubTotal(), 2) . PHP_EOL;
        $summary .= "Shipping: $" . number_format($this->calculateShipping(), 2) . PHP_EOL;
        $summary .= "Total: $" . number_format($this->calculateTotalWithShipping(), 2) . PHP_EOL;
        return $summary;
    }
}
