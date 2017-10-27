<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="actor")
 * @ApiResource(attributes={"normalization_context"={"groups"={"actor"}}})
 */
class Actor
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"movie", "actor"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"actor"})
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"actor"})
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="Movie", mappedBy="actors")
     * @Serializer\Groups({"actor"})
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function addMovie(Movie $movie)
    {
        $this->movies[] = $movie;
    }

    public function getMovies()
    {
        return $this->movies;
    }
}
