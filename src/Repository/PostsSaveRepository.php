<?php

namespace App\Repository;

use App\Entity\PostsSave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostsSave|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostsSave|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostsSave[]    findAll()
 * @method PostsSave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsSaveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostsSave::class);
    }

    // /**
    //  * @return PostsSave[] Returns an array of PostsSave objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostsSave
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
