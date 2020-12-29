<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;




    /**
     * @ORM\Column(type="string", length=255)
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="note")
     */
    private $student;

    /**
     * @ORM\ManyToMany(targetEntity=Matter::class, inversedBy="notes")
     */
    private $matter;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->matter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
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



    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(string $session): self
    {
        $this->session = $session;

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

    /**
     * @return Collection|Matter[]
     */
    public function getMatter(): Collection
    {
        return $this->matter;
    }

    public function addMatter(Matter $matter): self
    {
        if (!$this->matter->contains($matter)) {
            $this->matter[] = $matter;
        }

        return $this;
    }

    public function removeMatter(Matter $matter): self
    {
        $this->matter->removeElement($matter);

        return $this;
    }
}
