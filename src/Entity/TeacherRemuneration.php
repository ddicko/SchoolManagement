<?php

namespace App\Entity;

use App\Repository\TeacherRemunerationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeacherRemunerationRepository::class)
 */
class TeacherRemuneration
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
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="teacherRemunerations")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="teacherRemunerations")
     */
    private $classroom;

    /**
     * @ORM\ManyToOne(targetEntity=Matter::class, inversedBy="teacherRemunerations")
     */
    private $matter;

    /**
     * @ORM\Column(type="integer")
     */
    private $paidAmountByClassAndMatter;

    /**
     * @ORM\Column(type="integer")
     */
    private $restToPayByClassAndMatter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTeacher(): ?Enseignant
    {
        return $this->teacher;
    }

    public function setTeacher(?Enseignant $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getMatter(): ?Matter
    {
        return $this->matter;
    }

    public function setMatter(?Matter $matter): self
    {
        $this->matter = $matter;

        return $this;
    }

    public function getPaidAmountByClassAndMatter(): ?int
    {
        return $this->paidAmountByClassAndMatter;
    }

    public function setPaidAmountByClassAndMatter(int $paidAmountByClassAndMatter): self
    {
        $this->paidAmountByClassAndMatter = $paidAmountByClassAndMatter;

        return $this;
    }

    public function getRestToPayByClassAndMatter(): ?int
    {
        return $this->paidAmountByClassAndMatter;
    }

    public function setRestToPayByClassAndMatter(int $restToPayByClassAndMatter): self
    {
        $this->restToPayByClassAndMatter = $restToPayByClassAndMatter;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
