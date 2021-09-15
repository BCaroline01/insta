<?php

namespace App\Entity;

use App\Repository\PostsSaveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostsSaveRepository::class)
 */
class PostsSave
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="postsSaves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class, inversedBy="postsSaves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_post;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdPost(): ?Posts
    {
        return $this->id_post;
    }

    public function setIdPost(?Posts $id_post): self
    {
        $this->id_post = $id_post;

        return $this;
    }
}
