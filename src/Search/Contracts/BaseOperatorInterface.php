<?php


namespace Impactaweb\Eloquent\Search\Contracts;


interface BaseOperatorInterface
{
    public function __construct($column, $operator, $value);
    public function getColumn() : string;
    public function getValue();
    public function getOperator() : string;
    public function getPrepend() : string;
    public function getAppend() : string;
}
