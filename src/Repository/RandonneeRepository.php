<?php

namespace App\Repository;

use App\Entity\Randonnee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Randonnee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Randonnee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Randonnee[]    findAll()
 * @method Randonnee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandonneeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Randonnee::class);
    }

    public function findRandonneeByCat($id)
    {
        return $this->createQueryBuilder('r')
            ->join('r.categorie','c')
            ->addSelect('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('r.titre', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTOP3Randonnees(){
        return $this->createQueryBuilder('r')
            ->Where('r.dateRando >= :dateNow')
            ->setParameter('dateNow', new \DateTime('now'))
            ->orderBy('r.titre', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

}
