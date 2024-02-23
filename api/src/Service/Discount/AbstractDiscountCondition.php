<?php

namespace App\Service\Discount;

use App\DTO\Travel;

abstract class AbstractDiscountCondition implements DiscountConditionInterface
{
    private ?DiscountConditionInterface $nextCondition = null;

    public static function createChain(DiscountConditionInterface $first, DiscountConditionInterface ...$conditions): DiscountConditionInterface
    {
        $head = $first;
        foreach ($conditions as $condition) {
            $head->setNext($condition);
            $head = $condition;
        }

        return $first;
    }

    public function setNext(DiscountConditionInterface $condition): DiscountConditionInterface
    {
        $this->nextCondition = $condition;

        return $condition;
    }

    abstract public function support(Travel $travel): bool;

    public function handle(Travel $travel): void
    {
        $this->nextCondition?->handle($travel);
    }

}