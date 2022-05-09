<?php

namespace App\Repository;

use App\Entity\Relationship;
use App\Entity\Test;
use App\Filters\Appliers\RelationshipNameFilter\RelationshipFilterDto;
use App\Filters\Appliers\RelationshipNameFilter\RelationshipNameFilterApplier;
use App\Filters\Shared\FilterParams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Test>
 *
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }


    public function findAllWithFilters(FilterParams $filterParams) {

        // creo la query di base con i join
        $qb = $this->createQueryBuilder('t')
            ->select('t', 'r')
            ->leftJoin(
                Relationship::class,
                'r',
                Join::WITH,
                't.id = r.tests'
            );

        // applico i filtri alla query
        // gli passo l'alias di default usato per filtrare sull'entità test
        // e gli passo uno specifico alias per l'entità relationship
        $filterParams->applyFilter($qb, 't', [
            RelationshipNameFilterApplier::KEY => 'r'
        ]);

        return $qb->getQuery()
            ->getScalarResult();
    }

}
