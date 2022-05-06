<?php

namespace App\Filters\Shared;


use Doctrine\ORM\QueryBuilder;
use InvalidArgumentException;

class FilterParams
{

    /** @var array<string, mixed> */
    protected array $data;

    /** @var FilterApplierInterface[] */
    protected array $appliers = [];

    /**
     * @param array<string, mixed> $data -> query parameters sent by url
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function addApplier(FilterApplierInterface $applier): self
    {
        if (array_key_exists($applier->key(), $this->appliers)) {
            throw new InvalidArgumentException($applier::class . ' is already set');
        }
        $this->appliers[$applier->key()] = $applier;
        return $this;
    }

    public function applyFilter(QueryBuilder $target, string $alias): void
    {
        foreach ($this->data as $key => $value) {
            if (array_key_exists($key, $this->appliers)) {
                $filterToApply = $this->appliers[$key];
                $filterToApply->buildDto($value);
                $filterToApply->apply($target, $alias);
            }
        }
    }
}
