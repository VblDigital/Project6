<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $newPass;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trick", mappedBy="user")
     */
    private $tricks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * User constructor.
     */
    public function __construct ()
    {
        $this->tricks = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @param string $id
     * @return User
     */
    public function setId( string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername( string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword( string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail( string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return User
     */
    public function setType( string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNewPass(): ?int
    {
        return $this->newPass;
    }

    /**
     * @param int $newPass
     * @return User
     */
    public function setNewPass( int $newPass): self
    {
        $this->newPass = $newPass;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTricks ()
    {
        return $this->tricks;
    }

    /**
     * @param Trick $trick
     * @return User
     */
    public function addTrick( Trick $trick): self
    {
        if($this->tricks->contains($trick)){
            $this->tricks->add($trick);
            $trick->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Trick $trick
     * @return User
     */
    public function removeTrick( Trick $trick): self
    {
        if($this->tricks->contains($trick)){
            $this->tricks->removeElement($trick);
            if($trick->getCategory() === $this){
                $trick->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments ()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     * @return User
     */
    public function addComment( Comment $comment):self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTrick($this);
        }

        return $this;
    }

    /**
     * @param Comment $comment
     * @return User
     */
    public function removeComment ( Comment $comment):self
    {
        if($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            if($comment->getTrick() === $this){
                $comment->setTrick(null);
            }
        }

        return $this;
    }
}
