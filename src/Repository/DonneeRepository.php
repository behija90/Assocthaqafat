<?php

namespace App\Repository;

use App\Entity\Donnees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Donnees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donnees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donnees[]    findAll()
 * @method Donnees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Donnees::class);
    }

    // /**
    //  * @return Donnees[] Returns an array of Donnees objects
    //  */
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
    public function findOneBySomeField($value): ?Donnees
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
