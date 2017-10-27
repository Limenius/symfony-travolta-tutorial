<?php
/**
 * @license MIT
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(min=2)
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="sale")
     */
    private $tickets;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    /**
     * getId.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getFullName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * setFullName
     *
     * @param string $fullName
     * @return Movie
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * getTickets.
     *
     * @return ArrayCollection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Add ticket
     *
     * @param Ticket $ticket
     *
     * @return Sale
     */
    public function addTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }
}
