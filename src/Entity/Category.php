<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trick", mappedBy="category")
     */
    private $tricks;

    public function __construct ()
    {
        $this->tricks = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var string $id
     * @return Category
     */
    public function setId( string $id): self
    {
        $this->id = $id;

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
     * @var string $name
     * @return Category
     */
    public function setName( string $name): self
    {
        $this->name = $name;

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
     * @var Trick $trick
     * @return Category
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
     * @var Trick $trick
     * @return Category
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
     * @param mixed $category
     */
    public function setCategory ( $category ): void
    {
        $this->category = $category;
    }
}
