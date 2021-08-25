<?php

namespace App\Entity;

use App\Repository\FollowersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowersRepository::class)
 */
class Followers
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
    private $follower;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="followers")
     */
    private $id_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFollower(): ?string
    {
        return $this->follower;
    }

    public function setFollower(string $follower): self
    {
        $this->follower = $follower;

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
