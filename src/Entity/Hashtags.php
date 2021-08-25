<?php

namespace App\Entity;

use App\Repository\HashtagsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HashtagsRepository::class)
 */
class Hashtags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=HashtagsPosts::class, inversedBy="id_hashtag")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hashtagsPosts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getHashtagsPosts(): ?HashtagsPosts
    {
        return $this->hashtagsPosts;
    }

    public function setHashtagsPosts(?HashtagsPosts $hashtagsPosts): self
    {
        $this->hashtagsPosts = $hashtagsPosts;

        return $this;
    }
}
