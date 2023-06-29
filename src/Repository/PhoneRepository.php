<?php

namespace App\Repository;

use App\Entity\Phone;
use App\Entity\PhoneSearch;
use App\Form\PhoneSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Phone>
 *
 * @method Phone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Phone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Phone[]    findAll()
 * @method Phone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Phone::class);
    }

    public function save(Phone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Phone $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchPhone(?PhoneSearch $PhoneSearch) :array
    {
        $queryBuilder= $this->createQueryBuilder('p');
        if($PhoneSearch->getMinPrice()){
           $queryBuilder->andWhere('p.price > :minPrice')
                    ->setParameter('minPrice', $PhoneSearch->getMinPrice());
        }
        if($PhoneSearch->getMaxPrice()){
            $queryBuilder->andWhere('p.price < :maxPrice')
                     ->setParameter('maxPrice', $PhoneSearch->getMaxPrice());
         }
         return $queryBuilder ->getQuery()
                    ->getResult()
                    ;
    }

//    /**
//     * @return Phone[] Returns an array of Phone objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Phone
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
