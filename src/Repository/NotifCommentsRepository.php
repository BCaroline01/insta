<?php

namespace App\Repository;

use App\Entity\NotifComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NotifComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotifComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotifComments[]    findAll()
 * @method NotifComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotifCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotifComments::class);
    }

    // /**
    //  * @return NotifComments[] Returns an array of NotifComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotifComments
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
