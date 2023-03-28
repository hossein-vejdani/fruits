<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Entity\Nutrition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'fetch-fruits',
    description: 'Add a short description for your command',
)]
class FetchFruitsCommand extends Command
{

    public function __construct(private EntityManagerInterface $em, private HttpClientInterface $httpClient){
        parent::__construct();
    }
    protected function configure(): void
    {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $response = $this->httpClient->request('GET', 'https://fruityvice.com/api/fruit/all');
        $fruits = $response->toArray();

        foreach($fruits as $fruit) {
            $nutrition = new Nutrition();
            $nutrition
            ->setCarbohydrates($fruit['nutritions']['carbohydrates'])
            ->setprotein($fruit['nutritions']['protein'])
            ->setfat($fruit['nutritions']['fat'])
            ->setCalories($fruit['nutritions']['calories'])
            ->setSugar($fruit['nutritions']['sugar']);
            
            $entity = new Fruit();
            $entity
            ->setName($fruit['name'])
            ->setFamily($fruit['family'])
            ->setGenus($fruit['genus'])
            ->setNutritions($nutrition);
    
            $this ->em->persist($entity);
            
        }
        
        $this->em->flush();

        $io->success('Finished!');

        return Command::SUCCESS;
    }
}
