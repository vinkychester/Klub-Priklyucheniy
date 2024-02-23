<?php

namespace App\Controller;

use App\DTO\Travel;
use App\Service\Discount\AbstractDiscountCondition;
use App\Service\Discount\BookingDiscountCondition;
use App\Service\Discount\ChildDiscountCondition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', methods: ['POST'])]
class DiscountApiController extends AbstractController
{
    #[Route('/calculate-discount', methods: ['POST'])]
    public function calculateDiscount(#[MapRequestPayload] Travel $travel): Response
    {
        $discountConditionChain = AbstractDiscountCondition::createChain(
            new ChildDiscountCondition(),
            new BookingDiscountCondition()
        );

        $discountConditionChain->handle($travel);

        return new Response($travel->getBasePrice(), 200);
    }
}