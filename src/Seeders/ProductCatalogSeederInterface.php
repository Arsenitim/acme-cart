<?php

namespace App\Seeders;

use App\Product\Product;

interface ProductCatalogSeederInterface
{
    /**
     * Returns an array of seeded Product objects
     *
     * @return Product[]
     */
    public static function seed(): array;
}
