<?php

namespace App\Entity;

use App\Repository\TimeslotRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $advertLimit;

    #[ORM\ManyToMany(targetEntity: Area::class, mappedBy: 'timeslots')]
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

    public function getAreas(): PersistentCollection
    {
        return $this->areas;
    }

    public function setAreas(PersistentCollection $areas): void
    {
        $this->areas = $areas;
    }


}
