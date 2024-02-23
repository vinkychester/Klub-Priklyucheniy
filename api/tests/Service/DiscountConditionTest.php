<?php

namespace App\Tests\Service;

use App\DTO\Travel;
use App\Service\Discount\AbstractDiscountCondition;
use App\Service\Discount\BookingDiscountCondition;
use App\Service\Discount\ChildDiscountCondition;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class DiscountConditionTest extends KernelTestCase
{
    public function testChildDiscountCondition()
    {
        $discountConditionChain = AbstractDiscountCondition::createChain(
            new ChildDiscountCondition(),
        );

        $travel = new Travel(10000, new \DateTimeImmutable('01.01.2020'));
        $discountConditionChain->handle($travel);
        $this->assertEquals(2000, $travel->getBasePrice());

        $travel = new Travel(10000, new \DateTimeImmutable('01.01.2017'));
        $discountConditionChain->handle($travel);
        $this->assertEquals(7000, $travel->getBasePrice());

        $travel = new Travel(100000, new \DateTimeImmutable('01.01.2017'));
        $discountConditionChain->handle($travel);
        $this->assertEquals(95500, $travel->getBasePrice());

        $travel = new Travel(10000, new \DateTimeImmutable('01.01.2010'));
        $discountConditionChain->handle($travel);
        $this->assertEquals(9000, $travel->getBasePrice());
    }

    public function testBookingDiscountCondition()
    {
        $this->travelTest(new \DateTimeImmutable("01.05.2025"), new \DateTimeImmutable("30.11.2024"), 9300);
        $this->travelTest(new \DateTimeImmutable("01.05.2025"), new \DateTimeImmutable("31.12.2024"), 9500);
        $this->travelTest(new \DateTimeImmutable("01.05.2025"), new \DateTimeImmutable("31.01.2025"), 9700);
    }

    private function travelTest(\DateTimeImmutable $travelStart, \DateTimeImmutable $dateOfPayment, float $price): void
    {
        $discountConditionChain = AbstractDiscountCondition::createChain(
            new BookingDiscountCondition(),
        );

        $travel = new Travel(10000, new \DateTimeImmutable('01.01.2020'));
        $travel->setDateTravelStart($travelStart);
        $travel->setDateOfPayment($dateOfPayment);
        $discountConditionChain->handle($travel);

        $this->assertEquals($price, $travel->getBasePrice());
    }
}