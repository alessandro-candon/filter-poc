<?php

namespace App\Filters\Shared;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class FilterApplierInterface
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    abstract public function key(): string;

    abstract public function apply(QueryBuilder $target, string $alias): void;

    abstract public function buildDto($data): void;

    abstract public function support(string $queryParamKey): bool;

    protected function validate(FilterDtoInterface $filterDto) {
        $errors = $this->validator->validate($filterDto);
        if (count($errors) > 0) {
            throw new \Exception((string)$errors, 400);
        }
    }
}
