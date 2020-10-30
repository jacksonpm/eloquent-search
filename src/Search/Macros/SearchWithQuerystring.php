<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Contracts\BaseMacroInterface;
use Illuminate\Support\Str;

class SearchWithQuerystring implements BaseMacroInterface
{

    public static function register()
    {
        return function (array $queryData, array $queryable = []) {
            $separator = config('eloquent_search.querystring_separator', '__');
            foreach ($queryData as $parameter => $value) {
                $parameter = str_replace($separator, '.', $parameter);
                [$operator, $parameter] = SearchWithQuerystring::getOperator($parameter);
                $isQueryable = SearchWithQuerystring::isParameterQueryable($parameter, $queryable);
                if (!$isQueryable) {
                    continue;
                }
                $this->search($parameter, $operator, $value);
            }
            return $this;
        };
    }

    public static function isParameterQueryable(string $parameter, array $availableQuery): bool
    {
        return in_array($parameter, $availableQuery);
    }

    public static function getOperator(string $parameter): array
    {
        $operators = array_keys(config('eloquent_search.operators'));
        $selectedOperator = 'exact';
        foreach ($operators as $operator) {

            // Operator verification
            $operatorInQuery = '.' . $operator;
            if (Str::endsWith($parameter, $operatorInQuery)) {
                $selectedOperator = $operator;
                $parameter = str_replace($operatorInQuery, '', $parameter);
                break;
            }
        }

        return [$selectedOperator, $parameter];
    }
}
