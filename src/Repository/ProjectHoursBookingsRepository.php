<?php

namespace App\Repository;

use App\Entity\ProjectHoursBookings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProjectHoursBookings|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectHoursBookings|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectHoursBookings[]    findAll()
 * @method ProjectHoursBookings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectHoursBookingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectHoursBookings::class);
    }

    // /**
    //  * @return ProjectHoursBookings[] Returns an array of ProjectHoursBookings objects
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
    public function findOneBySomeField($value): ?ProjectHoursBookings
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
