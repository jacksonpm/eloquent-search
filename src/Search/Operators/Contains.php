<?php


namespace Impactaweb\Eloquent\Search\Operators;


use Impactaweb\Eloquent\Search\Abstracts\BaseOperator;

class Contains extends BaseOperator
{

    public function getValue(): string
    {
        return '%' . $this->value . '%';
    }

    public function getOperator(): string
    {
        return 'LIKE';
    }
}
