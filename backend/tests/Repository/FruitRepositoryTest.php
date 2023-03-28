<?php

namespace App\Tests\Repository;

use App\Entity\Fruit;
use App\Entity\Nutrition;
use App\Repository\FruitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostRepositoryTest extends KernelTestCase
{

    private EntityManagerInterface $em;

    private FruitRepository $fruitRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $container = static::getContainer();

        $this->fruitRepository = $container->get(FruitRepository::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
    }


    public function testCreateFruit(): void
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
        $this->em->persist($entity);
        $this->em->flush();
        $this->assertNotNull($entity->getId());

        $byId = $this->fruitRepository->findOneBy(["id" => $entity->getId()]);
        $this->assertEquals("name", $byId->getName());
        $this->assertEquals("family", $byId->getFamily());
        $this->assertEquals("genus", $byId->getGenus());
    }

}