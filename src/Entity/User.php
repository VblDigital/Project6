<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"username"},
 *     message="Ce pseudonyme est déjà utilisé."
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doir contenir 6 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe doit être identique")
     */
     public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

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
     * user constructor.
     */
    public function __construct ()
    {
        $this->tricks = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @param string $id
     * @return user
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
     * @return user
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
     * @return user
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
     * @return user
     */
    public function setEmail( string $email): self
    {
        $this->email = $email;

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
     * @return user
     */
    public function setNewPass( int $newPass): self
    {
        $this->newPass = $newPass;

        return $this;
    }

    public function eraseCredentials ()
    {

    }

    public function getSalt ()
    {

    }

    public function getRoles ()
    {
        return ['ROLE_USER'];
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
     * @return user
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
     * @return user
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
     * @return user
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
     * @return user
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
