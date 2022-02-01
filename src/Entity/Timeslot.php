<?php

namespace App\Entity;

use App\Repository\TimeslotRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeslotRepository::class)]
class Timeslot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;


    #[ORM\Column(type: 'time')]
    private ?DateTimeInterface $start;

    #[ORM\Column(type: 'time')]
    private ?DateTimeInterface $end;


    #[ORM\Column(type: 'float')]
    private ?float $price;

    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'timeslots')]
    private ArrayCollection $areas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $advertLimit;


    public function __construct()
    {
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
     * @return DateTimeInterface|null
     */
    public function getStart(): ?DateTimeInterface
    {
        return $this->start;
    }

    /**
     * @param DateTimeInterface|null $start
     */
    public function setStart(?DateTimeInterface $start): void
    {
        $this->start = $start;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEnd(): ?DateTimeInterface
    {
        return $this->end;
    }

    /**
     * @param DateTimeInterface|null $end
     */
    public function setEnd(?DateTimeInterface $end): void
    {
        $this->end = $end;
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

    /**
     * @return int|null
     */
    public function getAdvertLimit(): ?int
    {
        return $this->advertLimit;
    }

    /**
     * @param int|null $advertLimit
     */
    public function setAdvertLimit(?int $advertLimit): void
    {
        $this->advertLimit = $advertLimit;
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

}
