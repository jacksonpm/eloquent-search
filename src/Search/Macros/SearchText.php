<?php


namespace Impactaweb\Eloquent\Search\Macros;


use Impactaweb\Eloquent\Search\Abstracts\BaseSearch;
use Impactaweb\Eloquent\Search\Contracts\SearchTextInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class SearchText extends BaseSearch implements SearchTextInterface
{

    public static function register()
    {
        return function (string $text, array $searchable = []) {
            $this->where(function (Builder $query) use ($text, $searchable) {

                // Get text parts
                $textParts = SearchText::getSearchTextParts($text);
                $model = $query->getModel();

                if (isset($model->searchable)) {
                    if (!empty($searchable)) {
                        $searchable = array_intersect($searchable, $model->searchable);
                    } else {
                        $searchable = $model->searchable;
                    }
                }

                if (empty($searchable)) {
                    throw ValidationException::withMessages(['Must provide search columns']);
                }

                foreach ($textParts as $search) {
                    $query->whereLike($searchable, $search);
                }
            });
            return $this;
        };
    }

    /**
     * Get a list of searchable parts from a given string
     * @param string $text
     * @return array
     */
    public static function getSearchTextParts(string $text): array
    {
        $text = preg_replace('/\s+/', ' ', trim($text));
        preg_match_all('~(?:[^\'"\s]+|\'[^\']*\'|"[^"]*")+~', $text, $parts);
        $textParts = [];
        if (!$parts[0]) {
            return [];
        }

        foreach ($parts[0] as $part) {
            $part = trim($part, ' "');
            if ($part !== '') {
                $textParts[] = $part;
            }
        }
        return $textParts;
    }

}
