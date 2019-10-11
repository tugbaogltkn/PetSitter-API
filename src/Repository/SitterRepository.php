<?php

namespace App\Repository;

use App\Entity\Sitter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sitter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sitter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sitter[]    findAll()
 * @method Sitter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sitter::class);
    }

    // /**
    //  * @return Sitter[] Returns an array of Sitter objects
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
    public function findOneBySomeField($value): ?Sitter
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
