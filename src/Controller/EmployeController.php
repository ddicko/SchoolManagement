<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeController extends AbstractController
{
    /**
     * @Route("/employe", name="employe")
     */
    public function index(): Response
    {
        return $this->render('employe/index.html.twig', [
            'controller_name' => 'EmployeController',
        ]);
    }

    /**
     * @Route("/ajout-employe", name="ajoutemploye")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class, $employe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($employe);
            $em->flush();
            $this->addFlash("succesinscriptionetudiant", "Employe ajouté avec succès!");
            return $this->redirectToRoute('ajoutemploye');
        }

        return $this->render('employe/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @return Response
     * @Route("/employe/liste", name="listeemploye")
     */
    public function listeStudent(EmployeRepository $employeRepository): Response
    {
        return $this->render('employe/liste.html.twig', [
            'listeemploye' => $employeRepository->findAll()
        ]);
    }
}
