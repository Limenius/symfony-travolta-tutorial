<?php
namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Sale;
use App\Entity\Movie;

/**
 * The Sale Event is dispatched every time a new sale is registered
 */
class SaleEvent extends Event
{
    const NAME = 'sale.created';

    protected $sale;

    public function __construct(Sale $sale, Movie $movie, int $numTickets)
    {
        $this->sale = $sale;
        $this->movie = $movie;
        $this->numTickets = $numTickets;
    }

    public function getSale()
    {
        return $this->sale;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function getNumTickets()
    {
        return $this->numTickets;
    }
}
