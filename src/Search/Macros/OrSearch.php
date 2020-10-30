<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Contracts\BaseMacroInterface;

class OrSearch implements BaseMacroInterface
{
    public static function register()
    {
        return function ($column, $operator, $value = null) {
            $this->search($column, $operator, $value, 'OR');
        };
    }
}
