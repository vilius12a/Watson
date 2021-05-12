<?php

namespace App\Repository;

use App\Entity\Procedure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Procedure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Procedure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Procedure[]    findAll()
 * @method Procedure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcedureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Procedure::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getAllQB(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id');
    }
}
