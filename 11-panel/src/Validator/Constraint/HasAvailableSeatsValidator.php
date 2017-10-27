<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HasAvailableSeatsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $available = $constraint->getMovie()->getAvailableSeats();
        if ($value > $available) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ number }}', $value)
                ->setParameter('{{ available }}', $available)
                ->addViolation();
        }
    }
}
