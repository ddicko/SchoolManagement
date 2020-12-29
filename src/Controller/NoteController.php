<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index(): Response
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }

    /**
     * 
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/student/note", name="ajoutnote")
     */
    public function addNote(Request $request, EntityManagerInterface $em): Response
    {
        $note = new Note();

        $form = $this->createForm(NoteType::class, $note);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($note);
            $em->flush();
        }

        return $this->render('note/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
