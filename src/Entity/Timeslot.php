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

    #[ORM\Column(type: 'datetime')]
    private $timeslotStart;

    #[ORM\Column(type: 'datetime')]
    private $timeslotEnd;

    #[ORM\Column(type: 'float')]
    private $timeslotPrice;

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

    public function getTimeslotStart(): ?\DateTimeInterface
    {
        return $this->timeslotStart;
    }

    public function setTimeslotStart(\DateTimeInterface $timeslotStart): self
    {
        $this->timeslotStart = $timeslotStart;

        return $this;
    }

    public function getTimeslotEnd(): ?\DateTimeInterface
    {
        return $this->timeslotEnd;
    }

    public function setTimeslotEnd(\DateTimeInterface $timeslotEnd): self
    {
        $this->timeslotEnd = $timeslotEnd;

        return $this;
    }

    public function getTimeslotPrice(): ?float
    {
        return $this->timeslotPrice;
    }

    public function setTimeslotPrice(float $timeslotPrice): self
    {
        $this->timeslotPrice = $timeslotPrice;

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
}
