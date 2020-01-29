<?php

namespace App\Repository;

use App\Entity\Recensie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recensie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recensie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recensie[]    findAll()
 * @method Recensie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecensieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recensie::class);
    }

    // /**
    //  * @return Recensie[] Returns an array of Recensie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recensie
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
