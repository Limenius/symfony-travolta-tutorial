<?php

namespace App\EventListener;

use App\Entity\Ticket;
use App\Event\SaleEvent;
use Doctrine\ORM\EntityManagerInterface;

class SaleListener
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSaleCreated(SaleEvent $event)
    {
        for ($i = 0; $i < $event->getNumTickets(); $i++) {
            $ticket = new Ticket();
            $ticket->setMovie($event->getMovie());
            $ticket->setSale($event->getSale());
            $ticket->setRow(1);
            $ticket->setSeat(1);
            $this->em->persist($ticket);
        }
    }
}
