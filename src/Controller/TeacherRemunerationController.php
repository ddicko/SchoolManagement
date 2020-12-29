<?php

namespace App\Controller;

use App\Entity\TeacherRemuneration;
use App\Form\TeacherRemunerationType;
use App\Repository\EnseignantRepository;
use App\Repository\TeacherRemunerationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherRemunerationController extends AbstractController
{
    /**
     * @Route("/teacher/remuneration", name="teacher_remuneration")
     */
    public function index(): Response
    {
        return $this->render('teacher_remuneration/index.html.twig', [
            'controller_name' => 'TeacherRemunerationController',
        ]);
    }


    /**
     * @Route("/paiement/teacherremuneration", name="teacherremuneration")
     */
    public function add(Request $request, EntityManagerInterface $em, TeacherRemunerationRepository $trr)
    {
        $remuneration = new TeacherRemuneration();

        $form = $this->createForm(TeacherRemunerationType::class, $remuneration);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Avant d'envoyer en base de donnée on verifie

            $response = $request->request->all()["teacher_remuneration"];
            $paidAmountForMatter = $remuneration->getMatter()->getAmountPaidForMatter();

            if ($response["amount"] > $paidAmountForMatter) {
                throw new Exception("Trooooopp");
            }

            $remunerations = $trr->findByClassroomAndMatter($response["classroom"], $response["matter"]);

            // Si le teacher n'a pas un enregistrement en rapport avec la classe

            if (!empty($remunerations)) {
                // On vérifie si le montant saisie ajouté au montant déjà existant n'est pas supérieur au montant payable pour la matière

                // 1- On récupère le montant total déjà payé
                $sum = 0;

                foreach ($remunerations as $oneRemuneration) {
                    $sum += $oneRemuneration->getAmount();
                }

                // 2- Montant déjà payé + montant saisi

                $updatedAmount = $sum + $response["amount"];

                // 3- Vérification

                if ($updatedAmount > $paidAmountForMatter) {
                    throw new Exception("Le montant est trop");
                }

                // 4- On peut envoyer en base parceque le montant n'est pas trop

                // Montant restant à payer

                $rest = $paidAmountForMatter - $updatedAmount;

                $remuneration->setPaidAmountByClassAndMatter($updatedAmount)->setRestToPayByClassAndMatter($rest);

                $em->persist($remuneration);
                $em->flush();
            }

            $remuneration->setPaidAmountByClassAndMatter($response["amount"])->setRestToPayByClassAndMatter($paidAmountForMatter - $response["amount"]);

            $em->persist($remuneration);
            $em->flush();
        }


        return $this->render('teacher_remuneration/ajout.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
