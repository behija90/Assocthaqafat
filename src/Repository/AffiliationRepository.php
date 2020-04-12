<?php

namespace App\Repository;

use App\Entity\Affiliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Affiliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affiliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affiliation[]    findAll()
 * @method Affiliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffiliationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Affiliation::class);
    }

//    /**
//     * @return Affiliation[] Returns an array of Affiliation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Affiliation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
