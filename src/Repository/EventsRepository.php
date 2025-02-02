<?php

namespace App\Repository;

use App\Entity\Events;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Events::class);
    }

    /**
     * @param User $referent
     * @return Events[]
     */
    public function findGamesByReferent(User $user): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.referent = :referent')
            ->setParameter('referent', $user)
            ->orderBy('e.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Events[]
     */
    public function getLastTenEvents()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.created_at', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Events[] Returns an array of Events objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Events
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
