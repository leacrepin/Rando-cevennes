<?php

namespace App\Entity;

use App\Repository\RandonneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RandonneeRepository::class)
 */
class Randonnee
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRando;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="randonnees")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=IncriptionRando::class, mappedBy="randonnees")
     */
    private $incriptionRandos;

    public function __construct()
    {
        $this->incriptionRandos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateRando(): ?\DateTimeInterface
    {
        return $this->dateRando;
    }

    public function setDateRando(\DateTimeInterface $dateRando): self
    {
        $this->dateRando = $dateRando;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|IncriptionRando[]
     */
    public function getIncriptionRandos(): Collection
    {
        return $this->incriptionRandos;
    }

    public function addIncriptionRando(IncriptionRando $incriptionRando): self
    {
        if (!$this->incriptionRandos->contains($incriptionRando)) {
            $this->incriptionRandos[] = $incriptionRando;
            $incriptionRando->addRandonnee($this);
        }

        return $this;
    }

    public function removeIncriptionRando(IncriptionRando $incriptionRando): self
    {
        if ($this->incriptionRandos->contains($incriptionRando)) {
            $this->incriptionRandos->removeElement($incriptionRando);
            $incriptionRando->removeRandonnee($this);
        }

        return $this;
    }
}
