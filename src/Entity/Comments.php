<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
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
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $like_comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_comment_parent;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_post;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=NotifComments::class, inversedBy="id_comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notifComments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getLikeComment(): ?bool
    {
        return $this->like_comment;
    }

    public function setLikeComment(bool $like_comment): self
    {
        $this->like_comment = $like_comment;

        return $this;
    }

    public function getIdCommentParent(): ?int
    {
        return $this->id_comment_parent;
    }

    public function setIdCommentParent(int $id_comment_parent): self
    {
        $this->id_comment_parent = $id_comment_parent;

        return $this;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post): self
    {
        $this->id_post = $id_post;

        return $this;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser( $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getNotifComments(): ?NotifComments
    {
        return $this->notifComments;
    }

    public function setNotifComments(?NotifComments $notifComments): self
    {
        $this->notifComments = $notifComments;

        return $this;
    }
}
