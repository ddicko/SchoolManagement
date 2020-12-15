<?php

namespace App\Controller;

use App\Entity\Matter;
use App\Form\MatterType;
use App\Repository\MatterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatterController extends AbstractController
{
    /**
     * @Route("/ajout-matter", name="ajoutmatter")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        // création d'un Objet matter
        $matter = new Matter();
        //création du formulaire
        $form = $this->createForm(MatterType::class, $matter);
        //Analyse de la réquête
        $form->handleRequest($request);
        //verification & persist and flush
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($matter);
            $em->flush();
            return $this->redirectToRoute('matter');
        }

        return $this->render('matter/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Undocumented function
     *
     * @param MatterRepository $matterRepository
     * @Route("/matter/liste", name="listematter")
     */
    public function listeMatter(MatterRepository $matterRepository)
    {
        return $this->render('matter/liste.html.twig',[
            'listematter' => $matterRepository->findAll()
        ]);
    }
}
