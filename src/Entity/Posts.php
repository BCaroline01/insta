<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostsRepository::class)
 */
class Posts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $geolocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="posts")
     */
    private $id_user;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="id_post")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="id_post")
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity=HashtagsPosts::class, mappedBy="id_post")
     */
    private $hashtagsPosts;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->hashtagsPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getGeolocation(): ?string
    {
        return $this->geolocation;
    }

    public function setGeolocation(string $geolocation): self
    {
        $this->geolocation = $geolocation;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->id_user;
    }

    public function setIdUser(?Users $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdPost($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdPost() === $this) {
                $comment->setIdPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setIdPost($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getIdPost() === $this) {
                $medium->setIdPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HashtagsPosts[]
     */
    public function getHashtagsPosts(): Collection
    {
        return $this->hashtagsPosts;
    }

    public function addHashtagsPost(HashtagsPosts $hashtagsPost): self
    {
        if (!$this->hashtagsPosts->contains($hashtagsPost)) {
            $this->hashtagsPosts[] = $hashtagsPost;
            $hashtagsPost->setIdPost($this);
        }

        return $this;
    }

    public function removeHashtagsPost(HashtagsPosts $hashtagsPost): self
    {
        if ($this->hashtagsPosts->removeElement($hashtagsPost)) {
            // set the owning side to null (unless already changed)
            if ($hashtagsPost->getIdPost() === $this) {
                $hashtagsPost->setIdPost(null);
            }
        }

        return $this;
    }
}
