<?php

namespace App\Repository;

use App\Entity\Relationship;
use App\Filters\Appliers\RelationshipNameFilter\RelationshipFilterDto;
use App\Filters\Shared\FilterParams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Relationship>
 *
 * @method Relationship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relationship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relationship[]    findAll()
 * @method Relationship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relationship::class);
    }

    public function findAllWithFilters(FilterParams $filterParams) {

        $qb = $this->createQueryBuilder('r');

        $filterParams->applyFilter($qb, 'r');

        return $qb->getQuery()
            ->getScalarResult();
    }
}
