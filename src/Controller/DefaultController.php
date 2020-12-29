<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\ClassroomRepository;
use App\Repository\EnseignantRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(StudentRepository $studentRepository, ClassroomRepository $classroomRepository, EnseignantRepository $enseignantRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'students' => $studentRepository->findAll(),
            'nombreClasse' => $classroomRepository->countClasse(),
            'nombreEtudiant' => $studentRepository->countStudent(),
            'nombreEnseignant' => $enseignantRepository->countEnseignant(),
            'allClasse' => $classroomRepository->findAll(),
            'miage' => $studentRepository->countStudentByClassroom()
        ]);
    }
}
