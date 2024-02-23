<?php

namespace App\Service\Discount;

use App\DTO\Travel;

class ChildDiscountCondition extends AbstractDiscountCondition
{
    private const ADULT_AGE = 18;
    private const MAX_DISCOUNT = 4500;

    public function support(Travel $travel): bool
    {
        return $this->calculateAge($travel->getDateOfBirth()) < self::ADULT_AGE;
    }

    public function handle(Travel $travel): void
    {
        if (!$this->support($travel)) {
            parent::handle($travel);
        }

        $age = $this->calculateAge($travel->getDateOfBirth());

        $discount = match (true) {
            $age > 12 => DiscountService::calculateDiscount($travel->getBasePrice(), 0.1),
            $age > 6 => DiscountService::calculateDiscount($travel->getBasePrice(), 0.3, self::MAX_DISCOUNT),
            $age > 3 => DiscountService::calculateDiscount($travel->getBasePrice(), 0.8),
            default => 0,
        };

        $travel->setBasePrice($travel->getBasePrice() - $discount);

        parent::handle($travel);
    }

    private function calculateAge(\DateTimeImmutable $dateOfBirth): int
    {
        return $dateOfBirth->diff(new \DateTimeImmutable())->y;
    }
}