<?php

namespace App\Filters\Appliers\TestNameFilter;

use App\Filters\Shared\FilterApplierInterface;
use App\Filters\Shared\FilterDtoInterface;
use Doctrine\ORM\QueryBuilder;

class TestNameFilterApplier extends FilterApplierInterface
{
    const KEY = 'test_name';

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

    public function buildDto($data): FilterDtoInterface {
        $this->filterDto = new TestNameFilterDto($data);
        $this->validate($this->filterDto);
        return $this->filterDto;
    }
}
