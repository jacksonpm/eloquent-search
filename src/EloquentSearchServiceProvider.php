<?php

namespace Impactaweb\Eloquent;

use Impactaweb\Eloquent\Search\Macros\OrSearch;
use Impactaweb\Eloquent\Search\Macros\OrSearchBlock;
use Impactaweb\Eloquent\Search\Macros\Search;
use Impactaweb\Eloquent\Search\Macros\SearchBlock;
use Impactaweb\Eloquent\Search\Macros\SearchText;
use Impactaweb\Eloquent\Search\Macros\SearchWithQuerystring;
use Impactaweb\Eloquent\Search\Macros\WhereLike;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class EloquentSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Default configs
        $this->mergeConfigFrom(__DIR__.'/config/eloquent_search.php', 'eloquent_search');

        // Breadcrumb
        // Partial text search Macro
        Builder::macro('whereLike', WhereLike::register());
        Builder::macro('search', Search::register());
        Builder::macro('searchBlock', SearchBlock::register());
        Builder::macro('searchQueryString', SearchWithQuerystring::register());
        Builder::macro('orSearch', OrSearch::register());
        Builder::macro('orSearchBlock', OrSearchBlock::register());
        Builder::macro('searchText', SearchText::register());
    }
}
