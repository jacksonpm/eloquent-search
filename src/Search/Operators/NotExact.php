<?php


namespace Impactaweb\Eloquent\Search\Operators;


class NotExact extends Exact
{
    public function getOperator(): string
    {
        return '!=';
    }
}
