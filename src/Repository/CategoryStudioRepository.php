<?php

namespace App\Repository;

use App\Entity\CategoryStudio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryStudio|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStudio|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStudio[]    findAll()
 * @method CategoryStudio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryStudioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryStudio::class);
    }

    // /**
    //  * @return CategoryStudio[] Returns an array of CategoryStudio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryStudio
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
