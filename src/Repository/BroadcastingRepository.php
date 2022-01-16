<?php

namespace App\Repository;

use App\Entity\Broadcasting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Broadcasting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Broadcasting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Broadcasting[]    findAll()
 * @method Broadcasting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BroadcastingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Broadcasting::class);
    }

    // /**
    //  * @return Broadcasting[] Returns an array of Broadcasting objects
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
    public function findOneBySomeField($value): ?Broadcasting
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
