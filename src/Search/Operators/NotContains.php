<?php


namespace Impactaweb\Eloquent\Search\Operators;


class NotContains extends Contains
{
    public function getOperator(): string
    {
        return 'NOT LIKE';
    }
}
