<?php

namespace App\Seeders;

use App\Pricing\PriceStrategy;
use App\Pricing\PriceStrategyFactory;
use App\Product\Product;

class ProductCatalogueSeederRegular implements ProductCatalogSeederInterface
{
    /**
     * Returns an array of seeded Product objects
     *
     * @return Product[]
     */
    public static function seed(): array
    {
        return [
            'R01' => new Product(
                'R01',
                'Red Widget ',
                32.95,
                PriceStrategyFactory::create(PriceStrategy::REGULAR)
            ),
            'G01' => new Product(
                'G01',
                'Green Widget ',
                24.95,
                PriceStrategyFactory::create(PriceStrategy::REGULAR)
            ),
            'B01' => new Product(
                'B01',
                'Blue Widget ',
                7.95,
                PriceStrategyFactory::create(PriceStrategy::REGULAR)
            )
        ];
    }
}
