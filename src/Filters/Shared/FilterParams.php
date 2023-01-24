<?php

namespace App\Filters\Shared;


use Doctrine\ORM\QueryBuilder;
use InvalidArgumentException;

class FilterParams
{

    /** @var array<string, mixed> */
    protected array $data;

    /** @var FilterApplierAbstract[] */
    protected array $appliers = [];

    /**
     * @param array<string, mixed> $data -> query parameters sent by url
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function addApplier(FilterApplierAbstract $applier): self
    {
        if (array_key_exists($applier->key(), $this->appliers)) {
            throw new InvalidArgumentException($applier::class . ' is already set');
        }
        $this->appliers[$applier->key()] = $applier;
        return $this;
    }

    //applico le query di filtro
    // con i realativi alias
    public function applyFilter(QueryBuilder $target, string $defaultAlias, array $specificAliases = []): void
    {
        foreach ($this->data as $key => $value) {
            foreach ($this->appliers as $applier) {
                if ($applier->support($key)) {
                    $filterToApply = $this->appliers[$key];
                    $filterToApply->buildDto($value);

                    $alias = array_key_exists($filterToApply::KEY, $specificAliases) ?
                        $specificAliases[$filterToApply::KEY] : $defaultAlias;

                    $filterToApply->apply($target, $alias);
                }
            }
        }
    }
}
