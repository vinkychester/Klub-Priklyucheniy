<?php

namespace App\Service\Discount;

class DiscountService
{
    public static function calculateDiscount(float $basePrice, float $percent, ?float $maxDiscount = null): float
    {
        $discount = $basePrice * $percent;
        if ($maxDiscount && $discount > $maxDiscount) {
            return $maxDiscount;
        }

        return $discount;
    }
}