<?php

namespace App\Entity;

use App\Repository\HashtagsPostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HashtagsPostsRepository::class)
 */
class HashtagsPosts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class, inversedBy="hashtagsPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_post;

    /**
     * @ORM\OneToMany(targetEntity=Hashtags::class, mappedBy="hashtagsPosts")
     */
    private $id_hashtag;

    public function __construct()
    {
        $this->id_hashtag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPost(): ?Posts
    {
        return $this->id_post;
    }

    public function setIdPost(?Posts $id_post): self
    {
        $this->id_post = $id_post;

        return $this;
    }

    /**
     * @return Collection|Hashtags[]
     */
    public function getIdHashtag(): Collection
    {
        return $this->id_hashtag;
    }

    public function addIdHashtag(Hashtags $idHashtag): self
    {
        if (!$this->id_hashtag->contains($idHashtag)) {
            $this->id_hashtag[] = $idHashtag;
            $idHashtag->setHashtagsPosts($this);
        }

        return $this;
    }

    public function removeIdHashtag(Hashtags $idHashtag): self
    {
        if ($this->id_hashtag->removeElement($idHashtag)) {
            // set the owning side to null (unless already changed)
            if ($idHashtag->getHashtagsPosts() === $this) {
                $idHashtag->setHashtagsPosts(null);
            }
        }

        return $this;
    }
}
