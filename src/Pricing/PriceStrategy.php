<?php

namespace App\Pricing;

enum PriceStrategy: string
{
    case REGULAR = 'regular';
    case BUY_ONE_GET_SECOND_HALF_PRICE = 'buy_one_get_second_half_price';
}
