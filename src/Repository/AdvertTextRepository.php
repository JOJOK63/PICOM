<?php

namespace App\Repository;

use App\Entity\AdvertText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdvertText|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvertText|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvertText[]    findAll()
 * @method AdvertText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvertText::class);
    }

    // /**
    //  * @return AdvertText[] Returns an array of AdvertText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdvertText
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
