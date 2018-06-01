<?php

namespace App\Event;

use App\Entity\Movie;
use App\Entity\Sale;
use Symfony\Component\EventDispatcher\Event;

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
