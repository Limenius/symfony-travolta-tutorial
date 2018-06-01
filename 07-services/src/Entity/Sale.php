<?php
/**
 * @license MIT
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sale")
 */
class Sale
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="sale")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;

        return $this;
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
}
