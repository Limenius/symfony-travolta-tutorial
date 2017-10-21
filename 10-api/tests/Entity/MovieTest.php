<?php

namespace Tests\App\Entity;

use App\Entity\Movie;
use App\Entity\Ticket;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    public function testFindNextBestSeats()
    {
        $movie = new Movie();
        $result = $movie->findNextSeats(1);

        $this->assertCount(1, $result);
        $this->assertEquals(2, $result[0]['seat']);
        $this->assertEquals(2, $result[0]['row']);
    }

    public function testIsSeatAvailable()
    {
        $movie = new Movie();
        $result = $movie->isSeatAvailable(2, 2);
        $this->assertTrue($result);

        $ticket = new Ticket();
        $ticket->setRow(2);
        $ticket->setSeat(2);
        $movie->addTicket($ticket);
        $result = $movie->isSeatAvailable(2, 2);
        $this->assertFalse($result);
    }

    public function testFindNextBestSeatsAvailable()
    {
        $movie = new Movie();
        $ticket = new Ticket();
        $ticket->setRow(2);
        $ticket->setSeat(2);
        $movie->addTicket($ticket);
        $result = $movie->findNextSeats(1);
        $this->assertCount(1, $result);
        $this->assertEquals(3, $result[0]['seat']);
        $this->assertEquals(2, $result[0]['row']);
    }

}
