<?php

namespace App\Repository;

use App\Entity\Schooling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Schooling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schooling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schooling[]    findAll()
 * @method Schooling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schooling::class);
    }

    /**
      * @return Schooling[] Returns an array of Schooling objects
      */
    public function findByStudent($id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.student = :val')
            ->setParameter('val', $id)
            ->orderBy('s.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Schooling
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
