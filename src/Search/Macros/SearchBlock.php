<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Contracts\BaseMacroInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class SearchBlock implements BaseMacroInterface
{
    public static function register()
    {
        return function (array $block, string $condition = 'AND') {

            $condition = Str::upper($condition) == 'OR' ? 'OR' : 'AND';

            $this->where(function (Builder $q) use ($block) {
                foreach ($block as $searchLine) {
                    $column = $searchLine[0];
                    $operator = $searchLine[1];
                    $value = $searchLine[2] ?? null;
                    $condition = $searchLine[3] ?? 'AND';
                    $condition = Str::upper($condition) == 'OR' ? 'OR' : 'AND';

                    if (is_null($value)) {
                        $operator = 'exact';
                        $value = $searchLine[1];
                    }
                    $q->search($column, $operator, $value, $condition);
                }
            }, null, null, $condition);
            return $this;
        };
    }
}
