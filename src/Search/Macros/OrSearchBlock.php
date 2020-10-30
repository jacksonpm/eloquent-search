<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Contracts\BaseMacroInterface;

class OrSearchBlock implements BaseMacroInterface
{
    public static function register()
    {
        return function (array $block) {
            return $this->serchBlock($block, 'OR');
        };
    }
}
