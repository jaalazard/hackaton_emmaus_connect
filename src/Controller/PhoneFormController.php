<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneFormController extends AbstractController
{
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

            return $this->redirectToRoute('app_phone_form', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('phoneForm/phoneForm.html.twig', [
            'form' => $form,
        ]);
    }
}
