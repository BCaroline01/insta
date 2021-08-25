<?php

namespace App\Repository;

use App\Entity\HashtagsPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HashtagsPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashtagsPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashtagsPosts[]    findAll()
 * @method HashtagsPosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashtagsPostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HashtagsPosts::class);
    }

    // /**
    //  * @return HashtagsPosts[] Returns an array of HashtagsPosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HashtagsPosts
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
