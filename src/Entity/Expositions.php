<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpositionsRepository")
 */
class Expositions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_vues;

    /**
     * @ORM\Column(type="text")
     */
    private $description_fr;

    /**
     * @ORM\Column(type="text")
     */
    private $description_en;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="exposition")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Anonymes", mappedBy="exposition")
     */
    private $anonyme;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Oeuvres", inversedBy="exposition")
     */
    private $oeuvres;

    public function __construct()
    {
        $this->anonyme = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getNbVues(): ?int
    {
        return $this->nb_vues;
    }

    public function setNbVues(?int $nb_vues): self
    {
        $this->nb_vues = $nb_vues;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->description_fr;
    }

    public function setDescriptionFr(string $description_fr): self
    {
        $this->description_fr = $description_fr;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    public function getOrdre(): ?string
    {
        return $this->ordre;
    }

    public function setOrdre(?string $ordre): self
    { 
        $this->ordre = $ordre;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|anonymes[]
     */
    public function getAnonyme(): Collection
    {
        return $this->anonyme;
    }

    public function addAnonyme(anonymes $anonyme): self
    {
        if (!$this->anonyme->contains($anonyme)) {
            $this->anonyme[] = $anonyme;
            $anonyme->setExposition($this);
        }

        return $this;
    }

    public function removeAnonyme(anonymes $anonyme): self
    {
        if ($this->anonyme->contains($anonyme)) {
            $this->anonyme->removeElement($anonyme);
            // set the owning side to null (unless already changed)
            if ($anonyme->getExposition() === $this) {
                $anonyme->setExposition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|oeuvres[]
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(oeuvres $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
        }

        return $this;
    }

    public function removeOeuvre(oeuvres $oeuvre): self
    {
        if ($this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->removeElement($oeuvre);
        }

        return $this;
    }
}
