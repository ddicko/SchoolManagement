<?php

namespace App\Repository;

use App\Entity\TeacherRemuneration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TeacherRemuneration|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeacherRemuneration|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeacherRemuneration[]    findAll()
 * @method TeacherRemuneration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherRemunerationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeacherRemuneration::class);
    }

    /**
     * @return TeacherRemuneration[] Returns an array of TeacherRemuneration objects
     */
    public function findByClassroomAndMatter($classroom, $matter)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.classroom = :classroom')
            ->andWhere('t.matter = :matter')
            ->setParameter('classroom', $classroom)
            ->setParameter('matter', $matter)
            ->orderBy('t.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?TeacherRemuneration
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
