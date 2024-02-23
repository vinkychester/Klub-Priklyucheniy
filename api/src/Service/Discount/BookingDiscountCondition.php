<?php

namespace App\Service\Discount;

use App\DTO\Travel;

class BookingDiscountCondition extends AbstractDiscountCondition
{
    private const MAX_DISCOUNT = 1500;

    public function support(Travel $travel): bool
    {
        return $travel->getDateOfPayment() !== null;
    }

    public function handle(Travel $travel): void
    {
        if (!$this->support($travel)) {
            parent::handle($travel);
        }

        $config = BookingDiscountConfig::getConfig();

        foreach ($config as $item) {
            $dateStart = $this->parseDate($item["dateStart"]);
            $dateEnd = $this->parseDate(array_key_exists("dateEnd", $item) ? $item["dateEnd"]: []);

            if ($this->isSupportedInterval($travel->getDateTravelStart(), $dateStart, $dateEnd)) {
                foreach ($item["conditions"] as $condition) {
                    $date = $this->parseDate($condition);
                    if ($this->isSupportedDate($travel->getDateOfPayment(), $date)) {
                        $discount = DiscountService::calculateDiscount($travel->getBasePrice(), $condition["percent"], self::MAX_DISCOUNT);
                        $travel->setBasePrice($travel->getBasePrice() - $discount);
                        return;
                    }
                }
            }
        }

        parent::handle($travel);
    }

    private function parseDate(array $dateConfigItem): ?\DateTimeImmutable
    {
        try {
            $date = \DateTimeImmutable::createFromFormat("d.m",$dateConfigItem["date"]);
        } catch (\Exception $exception) {
            return null;
        }

        if (!array_key_exists("modify", $dateConfigItem)) {
            return  $date;
        }

        $modify = $date->modify($dateConfigItem["modify"]);
        if ($modify) {
            $date = $modify;
        }

        return $date;
    }

    private function isSupportedInterval(\DateTimeImmutable $dateTime, \DateTimeImmutable $dateStart, ?\DateTimeImmutable $dateEnd): bool
    {
        if ($dateEnd) {
            return $dateStart < $dateTime && $dateTime < $dateEnd;
        }
        return $dateStart < $dateTime;
    }

    private function isSupportedDate(\DateTimeImmutable $dateTime, \DateTimeImmutable $supportedDate): bool
    {
        return $dateTime <= $supportedDate;
    }
}