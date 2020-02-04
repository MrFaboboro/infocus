<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FotoRepository")
 */
class Foto
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
    private $titel;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $beschrijving;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="categorie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Camera", inversedBy="camera")
     * @ORM\JoinColumn(nullable=true)
     */
    private $camera;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="Reactie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileurl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fotos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(?string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

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

    public function getCamera(): ?Camera
    {
        return $this->camera;
    }

    public function setCamera(?Camera $camera): self
    {
        $this->camera = $camera;

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(?Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getFileurl(): ?string
    {
        return $this->fileurl;
    }

    public function setFileurl(string $fileurl): self
    {
        $this->fileurl = $fileurl;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
