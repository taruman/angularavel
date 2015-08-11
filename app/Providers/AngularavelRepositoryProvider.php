<?php

namespace angularavel\Providers;

use Illuminate\Support\ServiceProvider;

class AngularavelRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\angularavel\Repositories\ClienteRepository::class, \angularavel\Repositories\ClienteRepositoryEloquent::class);
    }
}
