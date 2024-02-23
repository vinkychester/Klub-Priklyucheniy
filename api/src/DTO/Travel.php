<?php

namespace App\DTO;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Annotation\Context;

class Travel
{
    private int $basePrice;
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'd.m.Y'])]
    private \DateTimeImmutable $dateOfBirth;
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'd.m.Y'])]
    private \DateTimeImmutable $dateTravelStart;
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'd.m.Y'])]
    private ?\DateTimeImmutable $dateOfPayment;

    public function __construct(int $basePrice, \DateTimeImmutable $dateOfBirth)
    {
        $this->basePrice = $basePrice;
        $this->dateOfBirth = $dateOfBirth;
        $this->dateTravelStart = new \DateTimeImmutable();
    }

    public function getBasePrice(): int
    {
        return $this->basePrice;
    }

    public function setBasePrice(int $basePrice): void
    {
        $this->basePrice = $basePrice;
    }

    public function getDateOfBirth(): \DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeImmutable $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getDateTravelStart(): \DateTimeImmutable
    {
        return $this->dateTravelStart;
    }

    public function setDateTravelStart(\DateTimeImmutable $dateTravelStart): void
    {
        $this->dateTravelStart = $dateTravelStart;
    }

    public function getDateOfPayment(): ?\DateTimeImmutable
    {
        return $this->dateOfPayment;
    }

    public function setDateOfPayment(?\DateTimeImmutable $dateOfPayment): void
    {
        $this->dateOfPayment = $dateOfPayment;
    }
}