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

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->price = 8;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * setRow
     *
     * @param int $row
     * @return Ticket
     */
    public function setRow(int $row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * setSeat
     *
     * @param int $seat
     * @return Ticket
     */
    public function setSeat(int $seat)
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * getPrice
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * setPrice
     *
     * @param int $price
     * @return Ticket
     */
    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * getMovie
     *
     * @return float
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * setMovie
     *
     * @param int $movie
     * @return Ticket
     */
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
        $movie->addTicket($this);

        return $this;
    }

    /**
     * getSale
     *
     * @return float
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * setSale
     *
     * @param int $sale
     * @return Ticket
     */
    public function setSale(Sale $sale)
    {
        $this->sale = $sale;
        $sale->addTicket($this);

        return $this;
    }
}
