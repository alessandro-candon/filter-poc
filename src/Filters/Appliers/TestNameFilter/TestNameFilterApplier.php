<?php

namespace App\Filters\Appliers\TestNameFilter;

use App\Filters\Shared\FilterApplierInterface;
use App\Filters\Shared\FilterDtoInterface;
use Doctrine\ORM\QueryBuilder;

class TestNameFilterApplier extends FilterApplierInterface
{
    const KEY = 'test_name';

    private TestNameFilterDto $filterDto;

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
        $this->filterDto = new TestNameFilterDto($data);
        $this->validate($this->filterDto);
    }

    public function support(string $queryParamKey): bool
    {
        return $this->key() === $queryParamKey;
    }
}
