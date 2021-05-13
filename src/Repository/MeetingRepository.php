<?php

namespace App\Repository;

use App\Entity\Meeting;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meeting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meeting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meeting[]    findAll()
 * @method Meeting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meeting::class);
    }

    /**
     * @param string $role
     * @param User   $user
     *
     * @return Meeting[]
     */
    public function findByRoleAndUser(string $role, User $user): array
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.date');

        if ($role === User::ROLE_DOCTOR) {
            $qb->andWhere('m.doctor = :user');
        } else {
            $qb->andWhere('m.patient = :user');
        }

        return $qb->setParameter('user', $user)->getQuery()->getResult();
    }
}
