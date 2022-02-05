<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertRepository::class)]
#[ORM\InheritanceType("JOINED")]
abstract class Advert
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $advertName;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\ManyToMany(targetEntity: Broadcasting::class, mappedBy: 'adverts')]
    private Collection $broadcastings;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isPaid;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'adverts')]
    private ?User $user;

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
    public function getAdvertName(): ?string
    {
        return $this->advertName;
    }

    /**
     * @param string|null $advertName
     */
    public function setAdvertName(?string $advertName): void
    {
        $this->advertName = $advertName;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Collection
     */
    public function getBroadcastings(): Collection
    {
        return $this->broadcastings;
    }

    /**
     * @param Collection $broadcastings
     */
    public function setBroadcastings(Collection $broadcastings): void
    {
        $this->broadcastings = $broadcastings;
    }

    /**
     * @return bool|null
     */
    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    /**
     * @param bool|null $isPaid
     */
    public function setIsPaid(?bool $isPaid): void
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
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

}
