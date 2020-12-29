<?php

namespace App\Controller;

use App\Entity\Matter;
use App\Form\MatterType;
use App\Repository\EnseignantRepository;
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
    public function add(Request $request, EntityManagerInterface $em, MatterRepository $matterRepository): Response
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
            $this->addFlash("succesmatter", "Matière ajouté avec succès!");
            return $this->redirectToRoute('ajoutmatter');
        }

        return $this->render('matter/index.html.twig', [
            'form' => $form->createView(),
            'matterliste' => $matterRepository->findBySomeLimit(5),

        ]);
    }

    /**
     * Undocumented function
     *
     * @param MatterRepository $matterRepository
     * @Route("/matter/liste", name="listematter")
     */
    public function listeMatter(MatterRepository $matterRepository, EnseignantRepository $enseignantRepository)
    {

        $sumcalcul = $matterRepository->findAll();

        $total = 0;

        foreach ($sumcalcul as $summmatter) {
            $total += $summmatter->getAmountPaidForMatter();
        }

        //dd($total);
        return $this->render('matter/liste.html.twig', [
            'listematter' => $matterRepository->findAll(),
            'total' => $total,
            'listeenseignant' => $enseignantRepository->findAll()
        ]);
    }
}
