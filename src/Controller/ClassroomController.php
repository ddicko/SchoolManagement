<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom/liste", name="classroomliste")
     */
    public function index(ClassroomRepository $classroomRepository): Response
    {
        return $this->render('classroom/liste.html.twig', [
            'classroomliste' => $classroomRepository->findAll(),
        ]);
    }

    /**
     *@Route("/classe/ajout", name = "ajoutclass")
     *  
     */
     public function addClassroom(Request $request, EntityManagerInterface $em)
     {

        $classroom = new Classroom();

        $form = $this->createForm(ClassroomType::class, $classroom);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($classroom);
            $em->flush();
            return  $this->redirectToRoute('ajoutclass');
        }
      
        return $this->render('classroom/ajout.html.twig', [
            'form' => $form->createView()
        ]);
     }
}
