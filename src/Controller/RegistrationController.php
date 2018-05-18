<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Registration;
use App\Form\RegistrationType;


class RegistrationController extends Controller
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request)
    {
        $em               = $this->getDoctrine()->getManager();
        $registration     = new Registration();
        $form             = $this->createForm(RegistrationType::class, $registration);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($registration);
            $em->flush();

        }

        return $this->render('registration/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}
