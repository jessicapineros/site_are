<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DatesFormations", mappedBy="category")
     */
    private $dates;

    public function __construct()
    {
        $this->dates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|DatesFormations[]
     */
    public function getDates(): Collection
    {
        return $this->dates;
    }

    public function addDate(DatesFormations $date): self
    {
        if (!$this->dates->contains($date)) {
            $this->dates[] = $date;
            $date->setCategory($this);
        }

        return $this;
    }

    public function removeDate(DatesFormations $date): self
    {
        if ($this->dates->contains($date)) {
            $this->dates->removeElement($date);
            // set the owning side to null (unless already changed)
            if ($date->getCategory() === $this) {
                $date->setCategory(null);
            }
        }

        return $this;
    }
}
