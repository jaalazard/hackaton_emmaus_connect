<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'home_')]
    public function index(PhoneRepository $phoneRepository): Response
    {
        $phones = $phoneRepository->findBy([], ['id' => 'DESC'], 3);
        return $this->render('home/index.html.twig', [
            'phones' => $phones,
        ]);
    }
}
