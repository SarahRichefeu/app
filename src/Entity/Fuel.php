<?php

namespace App\Entity;

use App\Repository\FuelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FuelRepository::class)]
class Fuel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'fuel', targetEntity: car::class)]
    private Collection $car_id;

    public function __construct()
    {
        $this->car_id = new ArrayCollection();
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
     * @return Collection<int, car>
     */
    public function getCarId(): Collection
    {
        return $this->car_id;
    }

    public function addCarId(car $carId): static
    {
        if (!$this->car_id->contains($carId)) {
            $this->car_id->add($carId);
            $carId->setFuel($this);
        }

        return $this;
    }

    public function removeCarId(car $carId): static
    {
        if ($this->car_id->removeElement($carId)) {
            // set the owning side to null (unless already changed)
            if ($carId->getFuel() === $this) {
                $carId->setFuel(null);
            }
        }

        return $this;
    }
}
