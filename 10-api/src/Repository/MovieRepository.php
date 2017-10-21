<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class MovieRepository extends EntityRepository
{
    public function findOneWithActors(int $movieId)
    {
        $query = $this->createQueryBuilder('m')
            ->select('m, a')
            ->leftJoin('m.actors', 'a')
            ->where('m.id = :id')
            ->setParameter('id', $movieId)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
}
