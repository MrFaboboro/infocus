<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
    private $name;

    /**
     * @ORM\Column(type="string", length=999)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="comment")
     */
    private $reactie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="comment")
     */
    private $Reactie;

    public function __construct()
    {
        $this->reactie = new ArrayCollection();
        $this->Reactie = new ArrayCollection();
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getReactie(): Collection
    {
        return $this->reactie;
    }

    public function addReactie(Categorie $reactie): self
    {
        if (!$this->reactie->contains($reactie)) {
            $this->reactie[] = $reactie;
            $reactie->setComment($this);
        }

        return $this;
    }

    public function removeReactie(Categorie $reactie): self
    {
        if ($this->reactie->contains($reactie)) {
            $this->reactie->removeElement($reactie);
            // set the owning side to null (unless already changed)
            if ($reactie->getComment() === $this) {
                $reactie->setComment(null);
            }
        }

        return $this;
    }
}