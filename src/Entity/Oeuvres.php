<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OeuvresRepository")
 */
class Oeuvres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $path;

    /**
     * @ORM\Column(type="boolean")
     */
    private $livre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="text")
     */
    private $description_fr;

    /**
     * @ORM\Column(type="text")
     */
    private $description_en;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artistes", inversedBy="oeuvre")
     */
    private $artiste;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Expositions", mappedBy="oeuvres")
     */
    private $exposition;

    public function __construct()
    {
        $this->exposition = new ArrayCollection();
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

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getlivre(): ?bool
    {
        return $this->livre;
    }

    public function setlivre(bool $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(?string $emplacement): self
    {
        $this->emplacement = $emplacement;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getArtiste()
    {
        return $this->artiste;
    }

    public function setArtiste($artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * @return Collection|Expositions[]
     */
    public function getExposition(): Collection
    {
        return $this->exposition;
    }

    public function addExposition(Expositions $exposition): self
    {
        if (!$this->exposition->contains($exposition)) {
            $this->exposition[] = $exposition;
            $exposition->addOeuvre($this);
        }

        return $this;
    }

    public function removeExposition(Expositions $exposition): self
    {
        if ($this->exposition->contains($exposition)) {
            $this->exposition->removeElement($exposition);
            $exposition->removeOeuvre($this);
        }

        return $this;
    }
}
