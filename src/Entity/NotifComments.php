<?php

namespace App\Entity;

use App\Repository\NotifCommentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotifCommentsRepository::class)
 */
class NotifComments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="notifComments")
     */
    private $id_comment;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="notifComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    public function __construct()
    {
        $this->id_comment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getIdComment(): Collection
    {
        return $this->id_comment;
    }

    public function addIdComment(Comments $idComment): self
    {
        if (!$this->id_comment->contains($idComment)) {
            $this->id_comment[] = $idComment;
            $idComment->setNotifComments($this);
        }

        return $this;
    }

    public function removeIdComment(Comments $idComment): self
    {
        if ($this->id_comment->removeElement($idComment)) {
            // set the owning side to null (unless already changed)
            if ($idComment->getNotifComments() === $this) {
                $idComment->setNotifComments(null);
            }
        }

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
