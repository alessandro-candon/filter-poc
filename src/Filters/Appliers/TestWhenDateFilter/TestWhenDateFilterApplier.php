<?php

namespace App\Filters\Appliers\TestWhenDateFilter;

use App\Filters\Shared\FilterApplierAbstract;
use App\Filters\Shared\FilterDtoInterface;
use App\Filters\Shared\Operators\MathFilterOperators;
use Doctrine\ORM\QueryBuilder;
use Exception;

class TestWhenDateFilterApplier extends FilterApplierAbstract
{
    const KEY = 'test_when_date';

    /** @var TestWhenDateFilterDto[]  */
    private array $testWhenDateDTOs;

    public function key(): string
    {
        return self::KEY;
    }

    public function apply(QueryBuilder $target, string $alias): void
    {
        foreach ($this->testWhenDateDTOs as $index => $testWhenDateDTO) {
            $operator = MathFilterOperators::mapping()[$testWhenDateDTO->getOperator()];
            $target
                ->andWhere(sprintf('%s.whenDate %s :%s', $alias, $operator, self::KEY.$index))
                ->setParameter(self::KEY.$index, $testWhenDateDTO->getWhenDate());
        }
    }

    /**
     * @throws Exception
     */
    public function buildDto($data): void
    {
        foreach ($data as $queryParamKey => $queryParamValue) {
            $dto = new TestWhenDateFilterDto($queryParamValue, $queryParamKey);
            $this->validate($dto);
            $this->testWhenDateDTOs[] = $dto;
        }
    }

    public function support(string $queryParamKey): bool
    {
        return str_replace(MathFilterOperators::mapping(), '', $queryParamKey) === $this->key();
    }
}
