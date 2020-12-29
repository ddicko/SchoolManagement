<?php

namespace App\Entity;

use App\Repository\MatterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatterRepository::class)
 */
class Matter
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
    private $hours;

    /**
     * @ORM\ManyToMany(targetEntity=Enseignant::class, mappedBy="speciality")
     */
    private $enseignants;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="matters")
     */
    private $classroom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountPaidForMatter;

    /**
     * @ORM\OneToMany(targetEntity=TeacherRemuneration::class, mappedBy="matter")
     */
    private $teacherRemunerations;

    /**
     * @ORM\ManyToMany(targetEntity=Note::class, mappedBy="matter")
     */
    private $notes;



    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
        $this->teacherRemunerations = new ArrayCollection();
        $this->notes = new ArrayCollection();
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

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants[] = $enseignant;
            $enseignant->addSpeciality($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            $enseignant->removeSpeciality($this);
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

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getAmountPaidForMatter(): ?int
    {
        return $this->amountPaidForMatter;
    }

    public function setAmountPaidForMatter(?int $amountPaidForMatter): self
    {
        $this->amountPaidForMatter = $amountPaidForMatter;

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
            $teacherRemuneration->setMatter($this);
        }

        return $this;
    }

    public function removeTeacherRemuneration(TeacherRemuneration $teacherRemuneration): self
    {
        if ($this->teacherRemunerations->removeElement($teacherRemuneration)) {
            // set the owning side to null (unless already changed)
            if ($teacherRemuneration->getMatter() === $this) {
                $teacherRemuneration->setMatter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->addMatter($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            $note->removeMatter($this);
        }

        return $this;
    }
}
