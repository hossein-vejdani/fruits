<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Nutrition;


#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $family = null;

    #[ORM\Column(length: 255)]
    private ?string $genus;


    #[ORM\Column(type: 'nutrition', nullable: true)]
    private $nutritions = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private DateTime|null $createdAt = null;


    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getFamily(): ?string
    {
        return $this->family;
    }
    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function getNutritions(): ?Nutrition
    {
        return $this->nutritions;
    }
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setFamily(string $family): self
    {
        $this->family = $family;
        return $this;
    }
    public function setGenus(string $genus): self
    {
        $this->genus = $genus;
        return $this;
    }

    public function setNutritions(Nutrition $nutrition): self
    {
        $this->nutritions = $nutrition;
        return $this;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
