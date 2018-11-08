<?php

namespace Laraveldaily\Home;

use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadViewsFrom(__DIR__.'/resources/views', 'home');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes/web.php';
        $this->app->make('Laraveldaily\Home\Controllers\FeedController');
        $this->app->make('Laraveldaily\Home\Controllers\HistoryController');
        $this->app->make('Laraveldaily\Home\Controllers\NewsfeedController');
        $this->app->make('Laraveldaily\Home\Controllers\CategoryController');
        $this->app->make('Laraveldaily\Home\Controllers\Newsupdate');

        $this->app->make('Laraveldaily\Home\DetailController');
        $this->app->make('Laraveldaily\Home\HomeController');
    }
}
