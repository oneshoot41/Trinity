<?php

namespace App\Repository;

use App\Entity\Anonymes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Anonymes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anonymes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anonymes[]    findAll()
 * @method Anonymes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnonymesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Anonymes::class);
    }

    // /**
    //  * @return Anonymes[] Returns an array of Anonymes objects
    //  */
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
    public function findOneBySomeField($value): ?Anonymes
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
