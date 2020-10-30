<?php


namespace Impactaweb\Eloquent\Search\Operators;


class NotIn extends In
{
    public function getOperator(): string
    {
        return 'NOT IN';
    }
}
