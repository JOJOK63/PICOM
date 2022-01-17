<?php

namespace App\Entity;

use App\Repository\AdvertImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertImageRepository::class)]
class AdvertImage extends Advert
{

    #[ORM\Column(type: 'text', length: 500)]
    private $url;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
