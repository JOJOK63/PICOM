<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertRepository::class)]
#[ORM\InheritanceType("JOINED")]
abstract class Advert
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $advertName;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\ManyToMany(targetEntity: Broadcasting::class, mappedBy: 'adverts')]
    private $broadcastings;

    #[ORM\Column(type: 'boolean')]
    private $isPaid;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'adverts')]
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdvertName(): ?string
    {
        return $this->advertName;
    }

    public function setAdvertName(string $advertName): self
    {
        $this->advertName = $advertName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * @return Collection
     */
    public function getBroadcastings(): Collection
    {
        return $this->broadcastings;
    }

    public function addBroadcasting(Broadcasting $broadcasting): self
    {
        if (!$this->broadcastings->contains($broadcasting)) {
            $this->broadcastings[] = $broadcasting;
            $broadcasting->addAdvert($this);
        }

        return $this;
    }

    public function removeBroadcasting(Broadcasting $broadcasting): self
    {
        if ($this->broadcastings->removeElement($broadcasting)) {
            $broadcasting->removeAdvert($this);
        }

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
