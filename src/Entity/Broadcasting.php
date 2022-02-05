<?php

namespace App\Entity;

use App\Repository\BroadcastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
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
    private PersistentCollection $adverts;


    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'broadcastings')]
    private PersistentCollection $areas;

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
     * @return PersistentCollection
     */
    public function getAdverts(): PersistentCollection
    {
        return $this->adverts;
    }


    /**
     * @param PersistentCollection $adverts
     * @return void
     */
    public function setAdverts(PersistentCollection $adverts): void
    {
        $this->adverts = $adverts;
    }


    /**
     * @return PersistentCollection
     */
    public function getAreas(): PersistentCollection
    {
        return $this->areas;
    }

    /**
     * @param PersistentCollection $areas
     */
    public function setAreas(PersistentCollection $areas): void
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
