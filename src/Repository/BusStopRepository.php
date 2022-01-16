<?php

namespace App\Repository;

use App\Entity\BusStop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusStop|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusStop|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusStop[]    findAll()
 * @method BusStop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusStopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusStop::class);
    }

    // /**
    //  * @return BusStop[] Returns an array of BusStop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusStop
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
