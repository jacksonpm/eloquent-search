<?php

namespace Impactaweb\Eloquent\Search\Contracts;

interface SearchTextInterface
{
    public static function getSearchTextParts(string $text): array;
}
