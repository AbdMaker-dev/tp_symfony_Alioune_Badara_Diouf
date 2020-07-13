<?php

namespace App\Repository;

use App\Entity\Etudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiants|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiants|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiants[]    findAll()
 * @method Etudiants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiants::class);
    }

    // /**
    //  * @return Etudiants[] Returns an array of Etudiants objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneBySomeField($field,$value): ?array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.'.$field.' LIKE :val')
            ->setParameter('val','%'.$value.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getbySomefield($type,$val)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM etudiants e INNER JOIN chambres c
            WHERE e.'.$type.' LIKE "%'.$val.'%" AND e.chambre_id = c.id AND e.id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM etudiants e INNER JOIN chambres c
            WHERE e.chambre_id = c.id AND e.id 
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
    
}
