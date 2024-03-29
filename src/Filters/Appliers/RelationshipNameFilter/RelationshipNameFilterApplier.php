<?php

namespace App\Filters\Appliers\RelationshipNameFilter;

use App\Filters\Shared\FilterApplierAbstract;
use App\Filters\Shared\FilterDtoInterface;
use Doctrine\ORM\QueryBuilder;

class RelationshipNameFilterApplier extends FilterApplierAbstract
{
    const KEY = 'relationship_name';

    private FilterDtoInterface $filterDto;

    public function key(): string
    {
        return self::KEY;
    }

    public function apply(QueryBuilder $target, string $alias): void
    {
        $target->andWhere(
            sprintf('%s.name = :name', $alias)
        )->setParameter('name', $this->filterDto->getName());
    }

    public function buildDto($data): void {
        $this->filterDto = new RelationshipFilterDto($data);
        $this->validate($this->filterDto);
    }

    public function support(string $queryParamKey): bool
    {
        return $this->key() === $queryParamKey;
    }
}
