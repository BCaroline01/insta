<?php

namespace App\Repository;

use App\Entity\SavePosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SavePosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method SavePosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method SavePosts[]    findAll()
 * @method SavePosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SavePostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SavePosts::class);
    }

    // /**
    //  * @return SavePosts[] Returns an array of SavePosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SavePosts
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
