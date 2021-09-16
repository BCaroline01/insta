<?php

namespace App\Entity;

use App\Entity\Users;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="id_post", cascade={"persist"})
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity=HashtagsPosts::class, mappedBy="id_post")
     */
    private $hashtagsPosts;

    /**
     * @ORM\Column(type="datetime")
     */
    public $publication_date;

    /**
     * @ORM\OneToMany(targetEntity=Likes::class, mappedBy="id_post")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=PostsSave::class, mappedBy="id_post", orphanRemoval=true)
     */
    private $postsSaves;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->hashtagsPosts = new ArrayCollection();
        $this->publication_date = new \DateTime('now');
        $this->likes = new ArrayCollection();
        $this->postsSaves = new ArrayCollection();
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

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Likes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setIdPost($this);
        }

        return $this;
    }

    public function removeLike(Likes $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getIdPost() === $this) {
                $like->setIdPost(null);
            }
        }

        return $this;
    }
     
     /**
      * function to know if a user like the post
      *
      * @param  Users $user
      * @return bool
      */
     public function isLikedByUser(Users $user) : bool
    {
        foreach($this->likes as $like){
            if($like->getIdUser() === $user) return true;
        }
        return false;
    }

       /**
      * function to know if a user like the post
      *
      * @param  Users $user
      * @return bool
      */
      public function isSavedByUser(Users $user) : bool
      {
          foreach($this->postsSaves as $postsSaves){
              if($postsSaves->getIdUser() === $user) return true;
          }
          return false;
      }

     /**
      * @return Collection|PostsSave[]
      */
     public function getPostsSaves(): Collection
     {
         return $this->postsSaves;
     }

     public function addPostsSave(PostsSave $postsSave): self
     {
         if (!$this->postsSaves->contains($postsSave)) {
             $this->postsSaves[] = $postsSave;
             $postsSave->setIdPost($this);
         }

         return $this;
     }

     public function removePostsSave(PostsSave $postsSave): self
     {
         if ($this->postsSaves->removeElement($postsSave)) {
             // set the owning side to null (unless already changed)
             if ($postsSave->getIdPost() === $this) {
                 $postsSave->setIdPost(null);
             }
         }

         return $this;
     }
}
