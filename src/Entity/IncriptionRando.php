<?php

namespace App\Entity;

use App\Repository\IncriptionRandoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=IncriptionRandoRepository::class)
 */
class IncriptionRando
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDemande;

    /**
     * @ORM\ManyToMany(targetEntity=Randonnee::class, inversedBy="incriptionRandos")
     */
    private $randonnees;

    public function __construct()
    {
        $this->randonnees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection|Randonnee[]
     */
    public function getRandonnees(): Collection
    {
        return $this->randonnees;
    }

    public function addRandonnee(Randonnee $randonnee): self
    {
        if (!$this->randonnees->contains($randonnee)) {
            $this->randonnees[] = $randonnee;
        }

        return $this;
    }

    public function removeRandonnee(Randonnee $randonnee): self
    {
        if ($this->randonnees->contains($randonnee)) {
            $this->randonnees->removeElement($randonnee);
        }

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('message', new Length(['min' => 5],['max' => 100]));
    }
}
