<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 * @ORM\Table(name="movie")
 * @ApiResource(attributes={"normalization_context"={"groups"={"movie"}}})
 */
class Movie
{

    const ROOM_ROWS = 5;
    const SEATS_PER_ROW = 5;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"movie", "actor"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"movie"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Groups({"movie"})
     */
    private $director;

    /**
     * @ORM\Column(type="smallint")
     * @Serializer\Groups({"movie"})
     */
    private $year;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"movie"})
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="Actor", inversedBy="movies")
     * @Serializer\Groups({"movie"})
     */
    private $actors;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="movie")
     */
    private $tickets;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    public function findNextSeats($num)
    {
        $tickets = $this->getTickets();
        $seats = [];
        for ($i = 0; $i < Movie::ROOM_ROWS; ++$i) {
            for ($j = 0; $j < Movie::SEATS_PER_ROW; ++$j) {
                $score = Movie::ROOM_ROWS / 2 - abs(Movie::ROOM_ROWS / 2 - $i) +
                Movie::SEATS_PER_ROW / 2 - abs(Movie::SEATS_PER_ROW / 2 - $i);
                if ($this->isSeatAvailable($i, $j)) {
                    $seats[] = ['score' => $score, 'row' => $i, 'seat' => $j];
                }
            }
        }
        usort($seats, function ($a, $b) {
            if ($a['score'] === $b['score']) {
                return 0;
            }

            return $a['score'] > $b['score'] ? -1 : +1;
        });

        return array_slice($seats, 0, $num);
    }

    public function isSeatAvailable($row, $seat)
    {
        foreach ($this->tickets as $ticket) {
            if ($ticket->getSeat() === $seat && $ticket->getRow() === $row) {
                return false;
            }
        }

        return true;
    }

    public function getAvailableSeats()
    {
        return Movie::ROOM_ROWS * Movie::SEATS_PER_ROW - count($this->tickets);
    }

    public function getTickets()
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    public function getActors()
    {
        return $this->actors;
    }

    public function addActor(Actor $actor)
    {
        $actor->addMovie($this);
        $this->actors[] = $actor;

        return $this;
    }

    public function removeActor(Actor $actor)
    {
        $this->actors->removeElement($actor);
        $actor->setMovie(null);

        return $this;
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

    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector(string $director)
    {
        $this->director = $director;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear(int $year)
    {
        $this->year = $year;

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

}
