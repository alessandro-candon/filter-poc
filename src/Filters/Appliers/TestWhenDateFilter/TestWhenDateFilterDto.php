<?php

namespace App\Filters\Appliers\TestWhenDateFilter;

use App\Filters\Shared\FilterDtoInterface;
use DateTimeImmutable;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;

class TestWhenDateFilterDto implements FilterDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private string $operator;

    private \DateTimeImmutable $whenDate;

    /**
     * @throws Exception
     */
    public function __construct($whenDateRaw, $operatorRaw)
    {
        $this->whenDate = new DateTimeImmutable($whenDateRaw);
        $this->operator = $operatorRaw;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getWhenDate(): DateTimeImmutable
    {
        return $this->whenDate;
    }

    /**
     * @param DateTimeImmutable $whenDate
     * @return TestWhenDateFilterDto
     */
    public function setWhenDate(DateTimeImmutable $whenDate): TestWhenDateFilterDto
    {
        $this->whenDate = $whenDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     * @return TestWhenDateFilterDto
     */
    public function setOperator(string $operator): TestWhenDateFilterDto
    {
        $this->operator = $operator;
        return $this;
    }
}
