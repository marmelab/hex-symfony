<?php

namespace App\Repository;

use App\Entity\Board;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Board|null find($id, $lockMode = null, $lockVersion = null)
 * @method Board|null findOneBy(array $criteria, array $orderBy = null)
 * @method Board[]    findAll()
 * @method Board[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Board::class);
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getByUUID(string $uuid)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.uuid = :val')
            ->setParameter('val', $uuid)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

}
