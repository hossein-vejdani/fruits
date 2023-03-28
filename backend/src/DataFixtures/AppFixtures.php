<?php

namespace App\DataFixtures;

use App\Entity\Fruit;
use App\Entity\Nutrition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nutrition = new Nutrition();
        $nutrition
        ->setCarbohydrates(1)
        ->setprotein(2)
        ->setfat(3)
        ->setCalories(4)
        ->setSugar(5);
        $entity = new Fruit();
        $entity->setName('name')
        ->setFamily('family')
        ->setGenus('genus')
        ->setNutritions($nutrition);
        $manager->persist($entity);
        $manager->flush();
    }
}
