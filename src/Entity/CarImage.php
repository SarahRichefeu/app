<?php

namespace App\Entity;

use App\Repository\CarImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarImageRepository::class)]
class CarImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\ManyToOne(inversedBy: 'carImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?car $car_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getCarId(): ?car
    {
        return $this->car_id;
    }

    public function setCarId(?car $car_id): static
    {
        $this->car_id = $car_id;

        return $this;
    }
}
