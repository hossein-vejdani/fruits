<?php

namespace App\DTO;

use App\Entity\Nutrition;
use Symfony\Component\Validator\Constraints as Assert;

class CreateFruitDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $name;
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $family;
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $genus;
    private ?Nutrition $nutritions;

    public function __construct(string $name = '', string $family = '', string $genus = '', Nutrition $nutritions = null)
    {
        $this->name = $name;
        $this->family = $family;
        $this->genus = $genus;
        $this->nutritions = $nutritions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getFamily(): string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;
        return $this;
    }

    public function getGenus(): string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;
        return $this;
    }

    public function getNutritions(): Nutrition
    {
        return $this->nutritions;
    }

    public function setNutritions(Nutrition $nutritions): self
    {
        $this->nutritions = $nutritions;
        return $this;
    }
}
