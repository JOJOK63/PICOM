<?php

namespace App\Entity;

use App\Repository\TimeslotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeslotRepository::class)]
class Timeslot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'time')]
    private $start;

    #[ORM\Column(type: 'time')]
    private $end;


    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'timeslots')]
    private $areas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $advertLimit;


    public function __construct()
    {
        $this->areas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Area[]
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(Area $area): self
    {
        if (!$this->areas->contains($area)) {
            $this->areas[] = $area;
            $area->addTimeslot($this);
        }

        return $this;
    }

    public function removeArea(Area $area): self
    {
        if ($this->areas->removeElement($area)) {
            $area->removeTimeslot($this);
        }

        return $this;
    }

    public function getAdvertLimit(): ?int
    {
        return $this->advertLimit;
    }

    public function setAdvertLimit(?int $advertLimit): self
    {
        $this->advertLimit = $advertLimit;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }
}
