<?php

namespace Erjanmx\LiveTinker;

use Illuminate\Support\ServiceProvider;


class LiveTinkerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'live-tinker');

        $this->publishes([
            __DIR__. '/resources/assets' => public_path('vendor/live-tinker'),
        ], 'public');
    }

    public function register()
    {
        if (env('APP_DEBUG')) {
            include __DIR__.'/routes.php';
            $this->app->make('Erjanmx\LiveTinker\Controllers\LiveTinkerController');
        };
    }
}
