<?php

namespace App\Filters\Appliers\TestNameFilter;

use App\Filters\Shared\FilterApplierInterface;
use App\Filters\Shared\FilterDtoInterface;
use Doctrine\ORM\QueryBuilder;
use phpDocumentor\Reflection\Types\This;

class TestNameFilterApplier extends FilterApplierInterface
{
    const KEY = 'name';

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
        $this->filterDto = new TestFilterDto($data);
        $this->validate($this->filterDto);
    }
}
