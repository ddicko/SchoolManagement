<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="classroom")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=Matter::class, mappedBy="classroom")
     */
    private $matters;

    /**
     * @ORM\OneToMany(targetEntity=TeacherRemuneration::class, mappedBy="classroom")
     */
    private $teacherRemunerations;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->matters = new ArrayCollection();
        $this->teacherRemunerations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClassroom($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getClassroom() === $this) {
                $student->setClassroom(null);
            }
        }

        return $this;
    }
    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Matter[]
     */
    public function getMatters(): Collection
    {
        return $this->matters;
    }

    public function addMatter(Matter $matter): self
    {
        if (!$this->matters->contains($matter)) {
            $this->matters[] = $matter;
            $matter->setClassroom($this);
        }

        return $this;
    }

    public function removeMatter(Matter $matter): self
    {
        if ($this->matters->removeElement($matter)) {
            // set the owning side to null (unless already changed)
            if ($matter->getClassroom() === $this) {
                $matter->setClassroom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TeacherRemuneration[]
     */
    public function getTeacherRemunerations(): Collection
    {
        return $this->teacherRemunerations;
    }

    public function addTeacherRemuneration(TeacherRemuneration $teacherRemuneration): self
    {
        if (!$this->teacherRemunerations->contains($teacherRemuneration)) {
            $this->teacherRemunerations[] = $teacherRemuneration;
            $teacherRemuneration->setClassroom($this);
        }

        return $this;
    }

    public function removeTeacherRemuneration(TeacherRemuneration $teacherRemuneration): self
    {
        if ($this->teacherRemunerations->removeElement($teacherRemuneration)) {
            // set the owning side to null (unless already changed)
            if ($teacherRemuneration->getClassroom() === $this) {
                $teacherRemuneration->setClassroom(null);
            }
        }

        return $this;
    }
}
