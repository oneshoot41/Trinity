<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistesRepository")
 */
class Artistes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $prenom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biographie_fr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biographie_en;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\oeuvres", mappedBy="artiste")
     */
    private $oeuvre;

    public function __construct()
    {
        $this->oeuvre = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBiographieFr(): ?string
    {
        return $this->biographie_fr;
    }

    public function setBiographieFr(?string $biographie_fr): self
    {
        $this->biographie_fr = $biographie_fr;

        return $this;
    }

    public function getBiographieEn(): ?string
    {
        return $this->biographie_en;
    }

    public function setBiographieEn(?string $biographie_en): self
    {
        $this->biographie_en = $biographie_en;

        return $this;
    }

    /**
     * @return Collection|oeuvres[]
     */
    public function getOeuvre(): Collection
    {
        return $this->oeuvre;
    }

    public function addOeuvre(oeuvres $oeuvre): self
    {
        if (!$this->oeuvre->contains($oeuvre)) {
            $this->oeuvre[] = $oeuvre;
            $oeuvre->setArtistes($this);
        }

        return $this;
    }

    public function removeOeuvre(oeuvres $oeuvre): self
    {
        if ($this->oeuvre->contains($oeuvre)) {
            $this->oeuvre->removeElement($oeuvre);
            // set the owning side to null (unless already changed)
            if ($oeuvre->getArtistes() === $this) {
                $oeuvre->setArtistes(null);
            }
        }

        return $this;
    }
}
