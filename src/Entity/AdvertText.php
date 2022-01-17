<?php

namespace App\Entity;

use App\Repository\AdvertTextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertTextRepository::class)]
class AdvertText extends Advert
{

    #[ORM\Column(type: 'text', length: 500)]
    private $content;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
