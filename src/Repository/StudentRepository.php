<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * @return Student[] Returns an array of Student objects
     */
    public function findBySomeLimit($limit)
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    public function countStudent()
    {
        $class =
            $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->select('COUNT(s.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function countStudentByClassroom()
    {

        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->select('COUNT(s.id) as value')
            ->where("s.classroom = 4");

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
    /*
    public function findOneBySomeField($value): ?Student
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
