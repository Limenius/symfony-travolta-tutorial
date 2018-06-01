<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasAvailableSeats extends Constraint
{
    public $message = 'This show does not have {{ number }} available seats.
    There are only {{ available }} seats available.';

    protected $movie;

    public function __construct($options)
    {
        $this->movie = $options['movie'];
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
