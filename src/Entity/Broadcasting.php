<?php

namespace App\Entity;

use App\Repository\BroadcastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: BroadcastingRepository::class)]
class Broadcasting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $broadcastStartDate;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $broadcastEndDate;

    #[ORM\ManyToMany(targetEntity: Advert::class, inversedBy: 'broadcastings')]
    private ArrayCollection $adverts;


    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'broadcastings')]
    private ArrayCollection $areas;

     public function __construct()
    {
        $this->adverts = new ArrayCollection();
        $this->areas = new ArrayCollection();
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
     * @return \DateTimeInterface|null
     */
    public function getBroadcastStartDate(): ?\DateTimeInterface
    {
        return $this->broadcastStartDate;
    }

    /**
     * @param \DateTimeInterface|null $broadcastStartDate
     */
    public function setBroadcastStartDate(?\DateTimeInterface $broadcastStartDate): void
    {
        $this->broadcastStartDate = $broadcastStartDate;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBroadcastEndDate(): ?\DateTimeInterface
    {
        return $this->broadcastEndDate;
    }

    /**
     * @param \DateTimeInterface|null $broadcastEndDate
     */
    public function setBroadcastEndDate(?\DateTimeInterface $broadcastEndDate): void
    {
        $this->broadcastEndDate = $broadcastEndDate;
    }

    /**
     * @return ArrayCollection
     */
    public function getAdverts(): ArrayCollection
    {
        return $this->adverts;
    }

    /**
     * @param ArrayCollection $adverts
     */
    public function setAdverts(ArrayCollection $adverts): void
    {
        $this->adverts = $adverts;
    }

    /**
     * @return ArrayCollection
     */
    public function getAreas(): ArrayCollection
    {
        return $this->areas;
    }

    /**
     * @param ArrayCollection $areas
     */
    public function setAreas(ArrayCollection $areas): void
    {
        $this->areas = $areas;
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
