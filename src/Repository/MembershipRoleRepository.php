<?php

namespace App\Repository;

use App\Entity\MembershipRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MembershipRole>
 *
 * @method MembershipRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembershipRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembershipRole[]    findAll()
 * @method MembershipRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembershipRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembershipRole::class);
    }

//    /**
//     * @return MembershipRole[] Returns an array of MembershipRole objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MembershipRole
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
