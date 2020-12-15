<?php

namespace App\Entity;

use App\Repository\SchoolingRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolingRepository::class)
 */
class Schooling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $paidAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $paidAmount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $remainingAmount;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="schooling")
     */
    private $student;

    public function __construct()
    {
        $this->paidAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaidAt(): ?\DateTimeInterface
    {
        return $this->paidAt;
    }

    public function setPaidAt(\DateTimeInterface $paidAt): self
    {
        $this->paidAt = $paidAt;

        return $this;
    }

    public function getPaidAmount(): ?int
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(int $paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getRemainingAmount(): ?int
    {
        return $this->remainingAmount;
    }

    public function setRemainingAmount(int $remainingAmount): self
    {
        $this->remainingAmount = $remainingAmount;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
    
}
