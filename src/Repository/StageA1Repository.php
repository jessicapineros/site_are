<?php

namespace App\Repository;

use App\Entity\StageA1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StageA1|null find($id, $lockMode = null, $lockVersion = null)
 * @method StageA1|null findOneBy(array $criteria, array $orderBy = null)
 * @method StageA1[]    findAll()
 * @method StageA1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageA1Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StageA1::class);
    }

//    /**
//     * @return StageA1[] Returns an array of StageA1 objects
//     */
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
    public function findOneBySomeField($value): ?StageA1
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
