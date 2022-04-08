<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\Table;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\NormalizerInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
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
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function distinctVue(){
        return $this->createQueryBuilder('cc')
            ->select(' cc.tab_resv ')
            ->distinct()
            ->getQuery()
            ->getResult()
            ;

    }

    public function sortPhone(): array{
        return $this->createQueryBuilder('c')
            ->orderBy('c.phone_resv' , 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM App:Reservation e
                WHERE e.Email_resv LIKE :str
                OR e.id_resv LIKE :str 
                OR e.phone_resv LIKE :str 
                OR e.tab_resv LIKE :str'

            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }


    /*
        public function findResByVue($vue){
            return $this->createQueryBuilder('c')
                ->where('c.tab_resv LIKE :tab_resv')
                ->setParameter('tab_resv', '%'.$vue.'%')
                ->getQuery()
                ->getArrayResult();
        }*/

}