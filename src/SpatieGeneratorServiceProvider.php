<?php

namespace GeTracker\SpatieGenerators;

use GeTracker\SpatieGenerators\Console\Commands\ActionMakeCommand;
use GeTracker\SpatieGenerators\Console\Commands\DTOMakeCommand;
use Illuminate\Support\ServiceProvider;

class SpatieGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->commands([
                ActionMakeCommand::class,
                DTOMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {

    }
}
