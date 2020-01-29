<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CameraRepository")
 */
class Camera
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
    private $camerabrand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cameratype;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="camera")
     */
    private $camera;

    public function __construct()
    {
        $this->camera = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCamerabrand(): ?string
    {
        return $this->camerabrand;
    }

    public function setCamerabrand(string $camerabrand): self
    {
        $this->camerabrand = $camerabrand;

        return $this;
    }

    public function getCameratype(): ?string
    {
        return $this->cameratype;
    }

    public function setCameratype(string $cameratype): self
    {
        $this->cameratype = $cameratype;

        return $this;
    }

    /**
     * @return Collection|Foto[]
     */
    public function getCamera(): Collection
    {
        return $this->camera;
    }

    public function addCamera(Foto $camera): self
    {
        if (!$this->camera->contains($camera)) {
            $this->camera[] = $camera;
            $camera->setCamera($this);
        }

        return $this;
    }

    public function removeCamera(Foto $camera): self
    {
        if ($this->camera->contains($camera)) {
            $this->camera->removeElement($camera);
            // set the owning side to null (unless already changed)
            if ($camera->getCamera() === $this) {
                $camera->setCamera(null);
            }
        }

        return $this;
    }
}
