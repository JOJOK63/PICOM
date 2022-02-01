<?php

namespace App\Entity;

use App\Repository\AdvertTextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertTextRepository::class)]
class AdvertText extends Advert
{

    #[ORM\Column(type: 'text', length: 500)]
    private ?string $content;

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }


}
