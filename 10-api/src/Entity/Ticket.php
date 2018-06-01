<?php
/**
 * @license MIT
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticket")
 */
class Ticket
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="tickets")
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="tickets")
     */
    private $sale;

    /**
     * @ORM\Column(type="smallint")
     */
    private $row;

    /**
     * @ORM\Column(type="smallint")
     */
    private $seat;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    public function __construct()
    {
        $this->price = 8;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function setRow(int $row)
    {
        $this->row = $row;

        return $this;
    }

    public function getSeat()
    {
        return $this->seat;
    }

    public function setSeat(int $seat)
    {
        $this->seat = $seat;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
        $movie->addTicket($this);

        return $this;
    }

    public function getSale()
    {
        return $this->sale;
    }

    public function setSale(Sale $sale)
    {
        $this->sale = $sale;
        $sale->addTicket($this);

        return $this;
    }
}
