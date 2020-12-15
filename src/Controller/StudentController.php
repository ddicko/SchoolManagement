<?php

namespace App\Controller;

use App\Entity\Matter;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\SchoolingRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    
    /**
     * @Route("/ajout-etudiant", name="ajoutstudent")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $student = new Student();

        $form=$this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('ajoutstudent');
        }

        return $this->render('student/index.html.twig', [
            'form' => $form->createView()
            ]);
    }

    /**
     *
     * @param StudentRepository $studentRepository
     * @return Response
     * @Route("/etudiant/liste", name="listeetudiant")
     */
    public function listeStudent(StudentRepository $studentRepository): Response
    {
        return $this->render('student/liste.html.twig', [
            'listestudent' => $studentRepository->findAll()
        ]);
    }

    /**
     * @Route("/toto", name="toto")
     *
     * @param StudentRepository $studentRepository
     * @return void
     */
    public function statusPaiementEtudiant(SchoolingRepository $schoolingRepository, StudentRepository $studentRepository){
        $schoolings=$schoolingRepository->findAll();


        $students=[];

        foreach ($schoolings as $schooling) {
            $studentId=$schooling->getStudent()->getId();

            $somme=0;

            foreach ($schoolingRepository->findByStudent($studentId) as $toto) {
                $somme += $toto->getPaidAmount();
            }

            $student=$studentRepository->findOneBy(['id'=>$studentId]);

            $student->totalPaidAmount=$somme;

            $student->restToPay=$student->getClassroom()->getAmount() - $somme;;

            $students[$studentId]=$student;
        }
        
        return $this->render('student/statutpaiements.html.twig', [
            "students"=>$students
        ]);
    }
}
