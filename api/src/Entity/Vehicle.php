<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ApiResource]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(['car' => Car::class, 'truck' => Truck::class])]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Tire>
     */
    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Tire::class, orphanRemoval: true)]
    private Collection $tires;

    public function __construct()
    {
        $this->tires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Tire>
     */
    public function getTires(): Collection
    {
        return $this->tires;
    }

    public function addTire(Tire $tire): static
    {
        if (!$this->tires->contains($tire)) {
            $this->tires->add($tire);
            $tire->setVehicle($this);
        }

        return $this;
    }

    public function removeTire(Tire $tire): static
    {
        if ($this->tires->removeElement($tire)) {
            // set the owning side to null (unless already changed)
            if ($tire->getVehicle() === $this) {
                $tire->setVehicle(null);
            }
        }

        return $this;
    }
}
