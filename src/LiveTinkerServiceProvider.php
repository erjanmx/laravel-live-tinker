<?php

namespace Erjanmx\LiveTinker;

use Illuminate\Support\ServiceProvider;
use Erjanmx\LiveTinker\Commands\LiveTinkerCommand;


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
        if ($this->app->runningInConsole()) {
            $this->commands([
                LiveTinkerCommand::class,
            ]);
        }
    }
}
