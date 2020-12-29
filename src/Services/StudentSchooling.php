<?php

namespace App\Services;

use App\Entity\Student;
use App\Repository\SchoolingRepository;
use App\Repository\StudentRepository;

class StudentSchooling
{
    protected $schoolingRepository;
    protected $studentRepository;

    public function __construct(SchoolingRepository $schoolingRepository, StudentRepository $studentRepository)
    {
        $this->schoolingRepository = $schoolingRepository;
        $this->studentRepository = $studentRepository;
    }

    public function paidSum()
    {

        $schoolings = $this->schoolingRepository->findAll();

        $students = [];

        foreach ($schoolings as $schooling) {
            $studentId = $schooling->getStudent()->getId();

            $somme = 0;

            foreach ($this->schoolingRepository->findByStudent($studentId) as $studentSchooling) {
                $somme += $studentSchooling->getPaidAmount();
            }

            $student = $this->studentRepository->findOneBy(['id' => $studentId]);

            $student->setTotalPaidAmount($somme);

            $student->setRestToPay($student->getClassroom()->getAmount() - $somme);

            if ($student->getRestToPay() <= 0) {
                $student->setStatus("Completed");
            } else {
                $student->setStatus("NOT Completed");
            }

            $students[$studentId] = $student;
        }

        return $students;
    }
}
