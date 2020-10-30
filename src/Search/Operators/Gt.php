<?php


namespace Impactaweb\Eloquent\Search\Operators;


use Impactaweb\Eloquent\Search\Abstracts\BaseOperator;

class Gt extends BaseOperator
{
    public function getOperator(): string
    {
        return '>';
    }
}
