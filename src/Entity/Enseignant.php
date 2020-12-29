<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity=Matter::class, inversedBy="enseignants")
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phonenumbers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @ORM\OneToMany(targetEntity=TeacherRemuneration::class, mappedBy="teacher")
     */
    private $teacherRemunerations;

    // /**
    //  * @ORM\Column(type="json")
    //  */
    private $paidAmounts = [];

    public function __construct()
    {
        $this->speciality = new ArrayCollection();
        $this->teacherRemunerations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection|Matter[]
     */
    public function getSpeciality(): Collection
    {
        return $this->speciality;
    }

    public function addSpeciality(Matter $speciality): self
    {
        if (!$this->speciality->contains($speciality)) {
            $this->speciality[] = $speciality;
        }

        return $this;
    }

    public function removeSpeciality(Matter $speciality): self
    {
        $this->speciality->removeElement($speciality);

        return $this;
    }

    public function getPhonenumbers(): ?string
    {
        return $this->phonenumbers;
    }

    public function setPhonenumbers(string $phonenumbers): self
    {
        $this->phonenumbers = $phonenumbers;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }
    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->phonenumbers;
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
            $teacherRemuneration->setTeacher($this);
        }

        return $this;
    }

    public function removeTeacherRemuneration(TeacherRemuneration $teacherRemuneration): self
    {
        if ($this->teacherRemunerations->removeElement($teacherRemuneration)) {
            // set the owning side to null (unless already changed)
            if ($teacherRemuneration->getTeacher() === $this) {
                $teacherRemuneration->setTeacher(null);
            }
        }

        return $this;
    }

    public function getPaidAmount(): array
    {
        return $this->paidAmounts;
    }

    public function setPaidAmount($paidAmounts, $key): self
    {
        $this->paidAmounts[$key] = $paidAmounts;

        return $this;
    }
}
