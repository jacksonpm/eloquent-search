<?php


namespace Impactaweb\Eloquent\Search\Contracts;


interface BaseSearchInterface
{
    public static function query(string $column, $operator, $value): array;

    public static function searchRelation($query, string $sql, array $bindings, &$relations, $column): void;
}
