<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Schooling;
use App\Form\SchoolingType;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SchoolingController extends AbstractController
{
    /**
     * @Route("/schooling", name="schooling")
     */
    public function index(): Response
    {
        return $this->render('schooling/index.html.twig', [
            'controller_name' => 'SchoolingController',
        ]);
    }

    /**
     * 
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("/paiement/schoolarité", name="paiement")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $schooling = new Schooling();

        $form = $this->createForm(SchoolingType::class, $schooling);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($schooling);
            $em->flush();

            return $this->redirectToRoute('paiement');
        }

        return $this->render('schooling/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
