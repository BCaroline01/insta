<?php

namespace App\Entity;

use App\Repository\SavePostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SavePostsRepository::class)
 */
class SavePosts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Posts::class)
     */
    private $id_post;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     */
    private $id_user;

    public function __construct()
    {
        $this->id_post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Posts[]
     */
    public function getIdPost(): Collection
    {
        return $this->id_post;
    }

    public function addIdPost(Posts $idPost): self
    {
        if (!$this->id_post->contains($idPost)) {
            $this->id_post[] = $idPost;
        }

        return $this;
    }

    public function removeIdPost(Posts $idPost): self
    {
        $this->id_post->removeElement($idPost);

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
}
