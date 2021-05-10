<?php

namespace App\Repository\Celebrity;

use App\Entity\Celebrity\Publicist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publicist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publicist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publicist[]    findAll()
 * @method Publicist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicist::class);
    }

    // /**
    //  * @return Publicist[] Returns an array of Publicist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Publicist
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
