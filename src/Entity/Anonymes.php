<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnonymesRepository")
 */
class Anonymes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ordre;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Expositions", inversedBy="anonyme")
     */
    private $exposition;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExposition(): ?Expositions
    {
        return $this->exposition;
    }

    public function setExposition(?Expositions $exposition): self
    {
        $this->exposition = $exposition;

        return $this;
    }
}
