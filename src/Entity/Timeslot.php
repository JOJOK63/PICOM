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

    #[ORM\ManyToMany(targetEntity: Broadcasting::class, inversedBy: 'timeslots')]
    private $broadcastings;

    public function __construct()
    {
        $this->broadcastings = new ArrayCollection();
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
     * @return Collection|Broadcasting[]
     */
    public function getBroadcastings(): Collection
    {
        return $this->broadcastings;
    }

    public function addBroadcasting(Broadcasting $broadcasting): self
    {
        if (!$this->broadcastings->contains($broadcasting)) {
            $this->broadcastings[] = $broadcasting;
        }

        return $this;
    }

    public function removeBroadcasting(Broadcasting $broadcasting): self
    {
        $this->broadcastings->removeElement($broadcasting);

        return $this;
    }
}
