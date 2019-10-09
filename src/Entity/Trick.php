<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_edit_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $chapo;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoLink;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tricks")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="modified_tricks")
     * @ORM\JoinColumn(name="contributor_id", referencedColumnName="id", nullable=false)
     */
    private $contributor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tricks")
     * @ORM\JoinColumn(name="categorie_ìd", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="trick")
     */
    private $comments;

    /**
     * Trick constructor.
     */
    public function __construct ()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Trick
     */
    public function setId( string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastEditDate():?\DateTimeInterface
    {
        return $this->last_edit_date;
    }

    /**
     * @param \DateTimeInterface $last_edit_date
     * @return Trick
     */
    public function setLastEditDate( \DateTimeInterface $last_edit_date)
    {
        $this->last_edit_date = $last_edit_date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Trick
     */
    public function setName( string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChapo(): ?string
    {
        return $this->chapo;
    }

    /**
     * @param string $chapo
     * @return Trick
     */
    public function setChapo( string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Trick
     */
    public function setDescription( string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageLink(): ?string
    {
        return $this->imageLink;
    }

    /**
     * @param string|null $imageLink
     * @return Trick
     */
    public function setImageLink( ?string $imageLink): self
    {
        $this->imageLink = $imageLink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    /**
     * @param string|null $videoLink
     * @return Trick
     */
    public function setVideoLink( ?string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param $author
     * @return mixed
     */
    public function setAuthor ( $author )
    {
        $this->author = $author;

        return $author;
    }

    /**
     * @return mixed
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param $contributor
     * @return mixed
     */
    public function setContributor ( $contributor )
    {
        $this->contributor = $contributor;

        return $contributor;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function setCategory ( $category)
    {
        $this->category = $category;

        return $category;
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
     * @return Trick
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
     * @return Trick
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
