<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchCars($brand, $gear, $fuel, $minPrice, $maxPrice)
    {
        $sqlQuery = "SELECT from car WHERE 1=1";

        if ($brand !== null) {
            $sqlQuery .= " AND brand = :brand";
        }

        if ($gear !== null) {
            $sqlQuery .= " AND gear = :gear";
        }

        if ($fuel !== null) {
            $sqlQuery .= " AND fuel = :fuel";
        }

        if ($minPrice !== null) {
            $sqlQuery .= " AND price >= :minPrice";
        }

        if ($maxPrice !== null) {
            $sqlQuery .= " AND price <= :maxPrice";
        }

        $stmt = $this->getEntityManager()->getConnection()->prepare($sqlQuery);

        if ($brand !== null) {
            $stmt->bindValue('brand', $brand);
        }

        if ($gear !== null) {
            $stmt->bindValue('gear', $gear);
        }

        if ($fuel !== null) {
            $stmt->bindValue('fuel', $fuel);
        }

        if ($minPrice !== null) {
            $stmt->bindValue('minPrice', $minPrice);
        }

        if ($maxPrice !== null) {
            $stmt->bindValue('maxPrice', $maxPrice);
        }

        $stmt = $this->getEntityManager()->getConnection()->executeQuery($sqlQuery);
        $cars = $stmt->fetchAllAssociative();
        return $cars;
    }


//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
