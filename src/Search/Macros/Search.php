<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Abstracts\BaseSearch;
use Impactaweb\Eloquent\Search\Contracts\BaseMacroInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Search extends BaseSearch implements BaseMacroInterface
{
    public static function register()
    {
        return function ($column, $operator, $value = null, $condition = 'AND') {

            // Condition can be only OR or AND
            $condition = Str::upper($condition) == 'OR' ? 'OR' : 'AND';

            // The default operator is EXACT
            $operator = Str::lower($operator);
            if (is_null($value)) {
                $value = $operator;
                $operator = 'exact';
            }

            // Query Closure
            $this->where(function (Builder $query) use ($column, $operator, $value) {

                // If given column NOT contains relationships
                if (!Str::contains($column, '.')) {
                    [$sql, $bindings] = Search::query($column, $operator, $value);
                    $query->whereRaw($sql, $bindings);
                    return;
                }

                // If given column contains relationships
                $relations = explode('.', $column);
                $column = array_pop($relations);
                [$sql, $bindings] = Search::query($column, $operator, $value);
                Search::searchRelation($query, $sql, $bindings, $relations, $column);

            }, null, null, $condition);

            return $this;
        };
    }
}
