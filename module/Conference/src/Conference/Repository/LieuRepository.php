<?php

namespace Conference\Repository;

use Doctrine\ORM\EntityRepository;

class LieuRepository extends EntityRepository
{
    public function getLieu() {
        $querybuilder = $this->createQueryBuilder('l');
        return $querybuilder->select('l')
                            ->groupBy('l.nom')
                            ->orderBy('l.nom', 'ASC')
                            ->getQuery()->getResult();
    }
}
