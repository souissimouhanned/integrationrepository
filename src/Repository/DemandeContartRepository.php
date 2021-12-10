<?php

namespace App\Repository;

use App\Entity\DemandeContart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeContart|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeContart|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeContart[]    findAll()
 * @method DemandeContart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeContartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeContart::class);
    }

    // /**
    //  * @return DemandeContart[] Returns an array of DemandeContart objects
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
    public function findOneBySomeField($value): ?DemandeContart
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
