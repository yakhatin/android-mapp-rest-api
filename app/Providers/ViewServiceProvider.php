<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(
            'catalogs.list',
            'App\Http\View\Composers\CatalogsListComposer'
        );
        View::composer(
            'articles.list',
            'App\Http\View\Composers\ArticlesListComposer'
        );
        View::composer(
            'articles.create',
            'App\Http\View\Composers\CatalogsListComposer'
        );
    }
}