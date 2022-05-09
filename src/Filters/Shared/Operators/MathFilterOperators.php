<?php

namespace App\Filters\Shared\Operators;


class MathFilterOperators
{
    final const GREATER_QP = 'gt';
    final const GREATER_EQUALS_QP = 'gte';
    final const LESS_EQUALS_QP = 'lte';
    final const LESS_QP = 'lt';
    final const EQUALS_QP = 'eq';

    private const GREATER = '>';
    private const GREATER_EQUALS = '>=';
    private const LESS_EQUALS = '<=';
    private const LESS = '<';
    private const EQUALS = '=';

    /**
     * @return array<string, string>
     */
    final public static function mapping(): array {
        return [
            self::GREATER_QP => self::GREATER,
            self::GREATER_EQUALS_QP => self::GREATER_EQUALS,
            self::LESS_EQUALS_QP => self::LESS_EQUALS,
            self::LESS_QP => self::LESS,
            self::EQUALS_QP => self::EQUALS
        ];
    }

}
