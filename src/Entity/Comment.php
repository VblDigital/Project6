<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */

class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_ìd", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(name="trick_ìd", referencedColumnName="id", nullable=false)
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser ($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getTrick()
    {
        return $this->trick;
    }

    public function setTrick ($trick)
    {
        $this->trick = $trick;

        return $this;
    }
}
