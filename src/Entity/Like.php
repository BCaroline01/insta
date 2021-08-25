<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikeRepository::class)
 * @ORM\Table(name="`like`")
 */
class Like
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_post;

    /**
     * @ORM\ManyToOne(targetEntity=USers::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

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

    public function getIdUser(): ?USers
    {
        return $this->id_user;
    }

    public function setIdUser(?USers $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}
