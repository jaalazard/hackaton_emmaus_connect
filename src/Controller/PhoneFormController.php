<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\PhoneSearch;
use App\Form\PhoneSearchType;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneFormController extends AbstractController
{

    #[Route('/monStock', name: 'app_phone_stock')]
    public function myStock(PhoneRepository $phoneRepository, Request $request ): Response
    {
        $phoneSearch = new PhoneSearch();
        $form = $this->createForm(PhoneSearchType::class, $phoneSearch);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $phones = $phoneRepository->searchPhone($phoneSearch);
        } else {
        $phones = $phoneRepository->findAll();
        }

        return $this->render('phone/monStock.html.twig', [
            'phones' => $phones,
            'form' => $form,
        ]);
    
    }

    #[Route('/ajouterUnTelephone', name: 'app_phone_form')]
    public function index(Request $request, PhoneRepository $phoneRepository, Calculator $calculator): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phone->setUser($this->getUser());
            $phone->setCategory($calculator->CategoryCalculator($phone->getModel()->getRam(), $phone->getModel()->getMemory(), $phone->isIsBlocked(), $phone->getEtat()));
            $phone->setPrice($calculator->PriceCalculator($phone->getModel()->getRam(), $phone->getModel()->getMemory(), $phone->isIsBlocked(), $phone->getEtat()));
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
