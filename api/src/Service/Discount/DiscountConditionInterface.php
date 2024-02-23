<?php

namespace App\Service\Discount;

use App\DTO\Travel;

interface DiscountConditionInterface
{
    public function support(Travel $travel): bool;

    public function handle(Travel $travel): void;

    public function setNext(DiscountConditionInterface $condition): DiscountConditionInterface;
}