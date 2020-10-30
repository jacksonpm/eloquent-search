<?php


namespace Impactaweb\Eloquent\Search\Operators;


use Impactaweb\Eloquent\Search\Abstracts\BaseOperator;

class Exact extends BaseOperator
{
    public function getOperator(): string
    {
        return '=';
    }
}
