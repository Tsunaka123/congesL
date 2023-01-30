<?php

namespace App\Repository;

use App\Entity\CongesAnnule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CongesAnnule>
 *
 * @method CongesAnnule|null find($id, $lockMode = null, $lockVersion = null)
 * @method CongesAnnule|null findOneBy(array $criteria, array $orderBy = null)
 * @method CongesAnnule[]    findAll()
 * @method CongesAnnule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CongesAnnuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CongesAnnule::class);
    }

    public function save(CongesAnnule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CongesAnnule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CongesAnnule[] Returns an array of CongesAnnule objects
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

//    public function findOneBySomeField($value): ?CongesAnnule
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
