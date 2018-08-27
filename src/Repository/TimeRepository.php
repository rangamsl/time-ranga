<?php

namespace App\Repository;

use App\Entity\Time;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Time|null find($id, $lockMode = null, $lockVersion = null)
 * @method Time|null findOneBy(array $criteria, array $orderBy = null)
 * @method Time[]    findAll()
 * @method Time[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Time::class);
    }

    /**
     * @return Time[] Returns an array of Time objects
     */
    public function findRecent($maxResults = 10)
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Time[] Returns an array of Time objects
     */
    public function findHourMinutesToDo()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.hours is NULL')
            ->andWhere('t.minutes is NULL')
            ->andWhere('t.gratishours is NULL')
            ->andWhere('t.gratisminutes is NULL')
            /* For Testing:
            ->andWhere('t.id = 10542')
			// TESTED: 23180, 24234, 23538, 23276, 24198, 24126, 24074, 24030, 23938, 20230, 10140, 15720, 10542, 9279
//            ->andWhere('t.id = 23538 OR t.id = 23276')
//            ->andWhere('t.hours < 0')
//            ->andWhere("t.malformed <> ''")
//            ->setMaxResults(1)
			*/
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Time[] Returns an array of Time objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Time
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
