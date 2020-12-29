<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends AbstractController
{
    /**
     * Undocumented function
     * @Route("enseignant/ajout", name="ajoutenseignant")
     */
    public function add(Request $request, EntityManagerInterface $em, EnseignantRepository $enseignantRepository)
    {
        $enseignant = new Enseignant();

        $form = $this->createForm(EnseignantType::class, $enseignant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $day=$request->request->all()['enseignant']['age']['day'];
            // $month=$request->request->all()['enseignant']['age']['month'];


            $em->persist($enseignant);
            $em->flush();

            $this->addFlash("succesenseignant", "Enseignant ajouté avec succès!");
        }

        return $this->render('enseignant/ajout.html.twig', [
            'form' => $form->createView(),
            'listeenseignant' => $enseignantRepository->findBySomeLimit(5)
        ]);
    }

    /**
     * @Route("/enseignant/liste", name="listeenseignant")
     */
    public function listeEnseignant(EnseignantRepository $enseignantRepository): Response
    {
        return $this->render('enseignant/liste.html.twig', [
            'listeenseignant' => $enseignantRepository->findAll(),
        ]);
    }
}
