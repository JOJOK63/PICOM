<?php

namespace App\Entity;

use App\Repository\AdvertImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertImageRepository::class)]
class AdvertImage extends Advert
{

    #[ORM\Column(type: 'text', length: 500)]
    private ?string $url;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }


}
