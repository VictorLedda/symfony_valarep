<?php

namespace App\Repository;

use App\Entity\Formationsarep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formationsarep|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formationsarep|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formationsarep[]    findAll()
 * @method Formationsarep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationsarepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formationsarep::class);
    }

    // /**
    //  * @return Formationsarep[] Returns an array of Formationsarep objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formationsarep
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
