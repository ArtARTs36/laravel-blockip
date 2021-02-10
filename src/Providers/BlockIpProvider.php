<?php

namespace ArtARTs36\LaravelBlockIp\Providers;

use ArtARTs36\LaravelBlockIp\Console\Commands\GetNewIps;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class BlockIpProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

            if ((float) Application::VERSION < 8) {
                $this
                    ->app
                    ->make(EloquentFactory::class)
                    ->load(__DIR__ . '/../../database/factories');
            }

            $this->commands([
                GetNewIps::class,
            ]);
        }
    }
}
