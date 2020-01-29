<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecensieRepository")
 */
class Recensie
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
    private $reviewtext;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewtext(): ?string
    {
        return $this->reviewtext;
    }

    public function setReviewtext(string $reviewtext): self
    {
        $this->reviewtext = $reviewtext;

        return $this;
    }
}
