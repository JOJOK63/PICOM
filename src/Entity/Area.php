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
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameArea;

    #[ORM\Column(type: 'float')]
    private $priceArea;

    #[ORM\ManyToMany(targetEntity: Broadcasting::class, inversedBy: 'areas')]
    private $broadcastings;

    #[ORM\OneToMany(mappedBy: 'area', targetEntity: BusStop::class)]
    private $busStops;

    public function __construct()
    {
        $this->broadcastings = new ArrayCollection();
        $this->busStops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameArea(): ?string
    {
        return $this->nameArea;
    }

    public function setNameArea(string $nameArea): self
    {
        $this->nameArea = $nameArea;

        return $this;
    }

    public function getPriceArea(): ?float
    {
        return $this->priceArea;
    }

    public function setPriceArea(float $priceArea): self
    {
        $this->priceArea = $priceArea;

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

    /**
     * @return Collection|BusStop[]
     */
    public function getBusStops(): Collection
    {
        return $this->busStops;
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
}
