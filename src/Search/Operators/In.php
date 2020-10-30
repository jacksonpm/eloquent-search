<?php


namespace Impactaweb\Eloquent\Search\Operators;


use Impactaweb\Eloquent\Search\Abstracts\BaseOperator;

class In extends BaseOperator
{
    public function getValue(): array
    {
        $value = $this->value;
        if (!is_array($value)) {
            $value = explode(',', $value);
        }
        return $value;
    }

    public function getAppend(): string
    {
        return ')';
    }

    public function getPrepend(): string
    {
        return '(';
    }

    public function getOperator(): string
    {
        return 'IN';
    }
}
