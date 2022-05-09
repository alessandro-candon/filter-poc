<?php

namespace App\Filters\Appliers\RelationshipNameFilter;

use App\Filters\Shared\FilterApplierInterface;
use App\Filters\Shared\FilterDtoInterface;
use Doctrine\ORM\QueryBuilder;

class RelationshipNameFilterApplier extends FilterApplierInterface
{
    const KEY = 'relationship_name';

    private FilterDtoInterface $filterDto;

    public function key(): string
    {
        return self::KEY;
    }

    public function apply(QueryBuilder $target, string $alias): void
    {
        $target->where(
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
