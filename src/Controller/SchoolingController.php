<?php

namespace App\Controller;

use App\Entity\Schooling;
use App\Form\SchoolingType;
use App\Repository\SchoolingRepository;
use App\Repository\StudentRepository;
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
    public function add(Request $request, EntityManagerInterface $em, SchoolingRepository $schoolingRepository, StudentRepository $studentRepository)
    {
        $schooling = new Schooling();

        $form = $this->createForm(SchoolingType::class, $schooling);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $id = intval($request->request->all()["schooling"]["student"]);

            // dd(intval($request->request->all()["schooling"]["student"]));
            $student = $studentRepository->findOneBy(['id' => $id]);

            $firstMountPaidForm = $request->request->all()["schooling"]["paidAmount"];


            if (!empty($schoolingRepository->findByStudent($id))) {
                $somme = 0;

                foreach ($schoolingRepository->findByStudent($id) as $studentSchooling) {
                    $somme += $studentSchooling->getPaidAmount();
                }

                $student->setTotalPaidAmount($somme + $firstMountPaidForm);

                $student->setRestToPay(intval($student->getClassroom()->getAmount() - ($somme + $firstMountPaidForm)));

                if ($student->getRestToPay() <= 0) {
                    $student->setStatus("Completed");
                } else {
                    $student->setStatus("NOT Completed");
                }
            } else {

                $student->setTotalPaidAmount($firstMountPaidForm)
                    ->setRestToPay($student->getClassroom()->getAmount() - $firstMountPaidForm);
                if (($student->getClassroom()->getAmount() - $firstMountPaidForm) <= 0) {
                    $student->setStatus("Completed");
                } else {
                    $student->setStatus("NOT Completed");
                }
            }

            $rest = $student->getRestToPay() >= 0 ? $student->getRestToPay() : 0;

            if ($student->getRestToPay() < 0) {
                $this->addFlash("errorpaieetudiant", "l'etudiant vous doit moins que ça!, il vous doit $rest Fcfa!");
            } else {
                $em->persist($student);
                $em->persist($schooling);

                $em->flush();
                $this->addFlash("succespaieetudiant", "Paiement Effectué avec succès!");
            }

            return $this->redirectToRoute('paiement');
        }

        return $this->render('schooling/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
