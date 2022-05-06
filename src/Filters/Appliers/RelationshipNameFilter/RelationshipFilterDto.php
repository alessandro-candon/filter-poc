<?php

namespace App\Filters\Appliers\RelationshipNameFilter;

use App\Filters\Shared\FilterDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RelationshipFilterDto implements FilterDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private string $name;

    public function __construct($data)
    {
        // HERE YOU CAN CREATE DTO STRUCTURE as you want.... List of uuid... ecc
        $this->name = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
