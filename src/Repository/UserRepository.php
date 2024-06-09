<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository//implements PasswordUpgraderInterface

{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllWithPagination(int $page, int $limit, Client $client): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.client = :client')
            ->setParameter('client', $client)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
