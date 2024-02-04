<?php

namespace App\Repository;

use App\Entity\Assosiation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assosiation>
 *
 * @method Assosiation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assosiation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assosiation[]    findAll()
 * @method Assosiation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssosiationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assosiation::class);
    }

//    /**
//     * @return Assosiation[] Returns an array of Assosiation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Assosiation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
