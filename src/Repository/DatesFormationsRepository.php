<?php

namespace App\Repository;

use App\Entity\DatesFormations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DatesFormations|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatesFormations|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatesFormations[]    findAll()
 * @method DatesFormations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatesFormationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DatesFormations::class);
    }

//    /**
//     * @return DatesFormations[] Returns an array of DatesFormations objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatesFormations
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
