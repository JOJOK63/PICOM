<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
class Area
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'float')]
    private ?float $price;

    #[ORM\ManyToMany(targetEntity: Broadcasting::class, inversedBy: 'areas')]
    private ArrayCollection $broadcastings;

    #[ORM\OneToMany(mappedBy: 'area', targetEntity: BusStop::class)]
    private ArrayCollection $busStops;

    #[ORM\ManyToMany(targetEntity: Timeslot::class, inversedBy: 'areas')]
    #[ORM\JoinColumn(nullable: true)]
    private ArrayCollection $timeslots;

    #[ORM\Column(type: 'integer')]
    private $maxBusStop;

    public function __construct()
    {
        $this->broadcastings = new ArrayCollection();
        $this->busStops = new ArrayCollection();
        $this->timeslots = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return ArrayCollection
     */
    public function getBroadcastings(): ArrayCollection
    {
        return $this->broadcastings;
    }

    /**
     * @param ArrayCollection $broadcastings
     */
    public function setBroadcastings(ArrayCollection $broadcastings): void
    {
        $this->broadcastings = $broadcastings;
    }

    /**
     * @return ArrayCollection
     */
    public function getBusStops(): ArrayCollection
    {
        return $this->busStops;
    }

    /**
     * @param ArrayCollection $busStops
     */
    public function setBusStops(ArrayCollection $busStops): void
    {
        $this->busStops = $busStops;
    }

    /**
     * @return ArrayCollection
     */
    public function getTimeslots(): ArrayCollection
    {
        return $this->timeslots;
    }

    /**
     * @param ArrayCollection $timeslots
     */
    public function setTimeslots(ArrayCollection $timeslots): void
    {
        $this->timeslots = $timeslots;
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


    public function addBusStop(BusStop $busStop): self
    {
        if (!$this->busStops->contains($busStop)) {
            $this->busStops[] = $busStop;
            $busStop->setArea($this);
        }

        return $this;
    }

    public function removeBusStop(BusStop $busStop): self
    {
        if ($this->busStops->removeElement($busStop)) {
            // set the owning side to null (unless already changed)
            if ($busStop->getArea() === $this) {
                $busStop->setArea(null);
            }
        }

        return $this;
    }


    public function addTimeslot(Timeslot $timeslot): self
    {
        if (!$this->timeslots->contains($timeslot)) {
            $this->timeslots[] = $timeslot;
        }

        return $this;
    }

    public function removeTimeslot(Timeslot $timeslot): self
    {
        $this->timeslots->removeElement($timeslot);

        return $this;
    }

    public function getMaxBusStop(): ?int
    {
        return $this->maxBusStop;
    }

    public function setMaxBusStop(int $maxBusStop = 20): self
    {
        $this->maxBusStop = $maxBusStop;

        return $this;
    }
}
