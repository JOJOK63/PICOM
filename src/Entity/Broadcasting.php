<?php

namespace App\Entity;

use App\Repository\BroadcastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BroadcastingRepository::class)]
class Broadcasting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $broadcastStartDate;

    #[ORM\Column(type: 'datetime')]
    private $broadcastEndDate;

    #[ORM\ManyToMany(targetEntity: Advert::class, inversedBy: 'broadcastings')]
    private $adverts;


    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'broadcastings')]
    private $areas;

    public function __construct()
    {
        $this->adverts = new ArrayCollection();
        $this->areas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBroadcastStartDate(): ?\DateTimeInterface
    {
        return $this->broadcastStartDate;
    }

    public function setBroadcastStartDate(\DateTimeInterface $broadcastStartDate): self
    {
        $this->broadcastStartDate = $broadcastStartDate;

        return $this;
    }

    public function getBroadcastEndDate(): ?\DateTimeInterface
    {
        return $this->broadcastEndDate;
    }

    public function setBroadcastEndDate(\DateTimeInterface $broadcastEndDate): self
    {
        $this->broadcastEndDate = $broadcastEndDate;

        return $this;
    }

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        $this->adverts->removeElement($advert);

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
            $area->addBroadcasting($this);
        }

        return $this;
    }

    public function removeArea(Area $area): self
    {
        if ($this->areas->removeElement($area)) {
            $area->removeBroadcasting($this);
        }

        return $this;
    }
}
