<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneFormController extends AbstractController
{

    #[Route('/monStock', name: 'app_phone_stock', methods: ['GET'])]
    public function myStock(PhoneRepository $phoneRepository): Response
    {
        return $this->render('phone/monStock.html.twig', [
            'phones' => $phoneRepository->findAll(),
        ]);
    }

    #[Route('/ajouterUnTelephone', name: 'app_phone_form')]
    public function index(Request $request, PhoneRepository $phoneRepository): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phone->setUser($this->getUser());
            $phoneRepository->save($phone, true);

            $myPhone = $phoneRepository->findOneBy([], ['id' => 'DESC']);
            return $this->redirectToRoute('app_phone_one', ['phone' => $myPhone->getId()]);
        }

        return $this->render('phoneForm/phoneForm.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/telephone/{phone}', name: 'app_phone_one')]
    public function ShowPhone(Phone $phone): Response
    {
        return $this->render('phoneForm/phone.html.twig', [
            'phone' => $phone,
        ]);
    }
}
