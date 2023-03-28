<?php

namespace App\Controller;

use App\Entity\Fruit;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\CreateFruitDTO;
use App\DTO\PaginateAndFilterDTO;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('fruit', name: 'fruit')]
class FruitController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly SerializerInterface $serializer, private readonly MailerInterface $mailer, private readonly ValidatorInterface $validator)
    {
    }

    #[Route('/{x<\d+>?}', name: 'app_get_fruit', methods: ['GET'])]
    public function index(PaginateAndFilterDTO $param): Response
    {
        $repository = $this->em->getRepository(Fruit::class);
        $result = $repository->findByKeyword($param);
        return $this->json($result);
    }

    #[Route('', name: 'app_create_fruit', methods: ['POST'])]
    public function create(CreateFruitDTO $data): JsonResponse
    {
        $errors = $this->validator->validate($data);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
        $nutrition = $data->getNutritions();
        $fruit = new Fruit();
        $fruit
            ->setName($data->getName())
            ->setFamily($data->getFamily())
            ->setGenus($data->getGenus())
            ->setNutritions($nutrition);

        $this->em->persist($fruit);
        $this->em->flush();
        $mail = (new Email())
            ->from('admin@mail.com')
            ->to('hossein.vejdani.dev@gmail.com')
            ->subject('New fruit')
            ->text('A new fruit named ' . $fruit->getName() . ' has been added');
        $this->mailer->send($mail);
        return $this->json($fruit, 201);
    }
}
