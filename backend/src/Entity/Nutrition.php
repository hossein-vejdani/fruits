<?php

namespace App\Entity;

class Nutrition
{
    public ?int $carbohydrates;
    public ?int $protein;
    public ?int $fat;
    public ?int $calories;
    public ?int $sugar;

    public function __construct()
    {
        $this->carbohydrates = null;
        $this->protein = null;
        $this->fat = null;
        $this->calories = null;
        $this->sugar = null;
    }

    public function setCarbohydrates(?int $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;
        return $this;
    }



    public function setProtein(?int $protein): self
    {
        $this->protein = $protein;
        return $this;
    }

    public function setFat(?int $fat): self
    {
        $this->fat = $fat;
        return $this;
    }

    public function setCalories(?int $calories): self
    {
        $this->calories = $calories;
        return $this;
    }

    public function setSugar(?int $sugar): self
    {
        $this->sugar = $sugar;
        return $this;
    }
}
