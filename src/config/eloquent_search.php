<?php


return [
    'operators' => [
        'in' => Impactaweb\Eloquent\Search\Operators\In::class,
        'exact' => Impactaweb\Eloquent\Search\Operators\Exact::class,
        'lt' => Impactaweb\Eloquent\Search\Operators\Lt::class,
        'lte' => Impactaweb\Eloquent\Search\Operators\Lte::class,
        'gt' => Impactaweb\Eloquent\Search\Operators\Gt::class,
        'gte' => Impactaweb\Eloquent\Search\Operators\Gte::class,
        'contains' => Impactaweb\Eloquent\Search\Operators\Contains::class,
        'not_contains' => Impactaweb\Eloquent\Search\Operators\Contains::class,
        'not_exact' => Impactaweb\Eloquent\Search\Operators\NotExact::class,
        'not_in' => Impactaweb\Eloquent\Search\Operators\NotIn::class,
    ],

    'querystring_separator' => '__'
];
