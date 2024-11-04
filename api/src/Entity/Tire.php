<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TireRepository::class)]
#[ApiResource]
class Tire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
