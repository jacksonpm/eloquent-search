<?php


namespace Impactaweb\Eloquent\Search\Abstracts;


use Impactaweb\Eloquent\Search\Contracts\BaseOperatorInterface;

abstract class BaseOperator implements BaseOperatorInterface
{
    protected $operator;
    protected $column;
    protected $value;

    public function __construct($column, $operator, $value)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getAppend(): string
    {
        return '';
    }

    public function getPrepend(): string
    {
        return '';
    }

    public function getSql(): array
    {
        $value = $this->getValue();
        $bindings = is_array($value) ? $value : [$value];
        $bindingsOperator = implode(',', array_pad([], count($bindings), '?'));

        $sql = implode(' ', [
            $this->getColumn(),
            $this->getOperator(),
            $this->getPrepend(),
            $bindingsOperator,
            $this->getAppend(),
        ]);

        return [$sql, $bindings];
    }

}
