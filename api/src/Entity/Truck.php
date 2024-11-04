<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TruckRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TruckRepository::class)]
#[ApiResource]
class Truck extends Vehicle
{
    #[ORM\Column]
    private ?float $length = null;

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): static
    {
        $this->length = $length;

        return $this;
    }
}
