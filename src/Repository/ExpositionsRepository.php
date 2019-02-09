<?php

namespace App\Repository;

use App\Entity\Expositions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Expositions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expositions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expositions[]    findAll()
 * @method Expositions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpositionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Expositions::class);
    }

    // /**
    //  * @return Expositions[] Returns an array of Expositions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expositions
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
