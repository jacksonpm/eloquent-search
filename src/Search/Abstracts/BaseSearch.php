<?php


namespace Impactaweb\Eloquent\Search\Abstracts;


use Impactaweb\Eloquent\Search\Contracts\BaseSearchInterface;

abstract class BaseSearch implements BaseSearchInterface
{
    public static function query(string $column, $operator, $value): array
    {
        // Get operator class
        $operatorClass = \config('eloquent_search.operators.' . $operator, null);
        if (is_null($operatorClass) || is_callable($operatorClass)) {
            throw new \Exception("Operator not found in config.");
        }
        $operator = new $operatorClass($column, $operator, $value);
        return $operator->getSql();
    }

    public static function searchRelation($query, string $sql, array $bindings, &$relations, $column): void
    {
        $relation = current($relations);
        $next = next($relations);

        // If next relation exist
        $query->whereHas($relation, function ($q) use ($bindings, $next, $column, $relations, $query, $sql) {
            if ($next) {
                self::searchRelation($q, $sql, $bindings, $relations, $column);
            } else {
                $q->whereRaw($sql, $bindings);
            }
        });

    }
}
