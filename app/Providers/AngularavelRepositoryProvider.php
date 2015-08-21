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
        
        $this->app->bind(\angularavel\Repositories\ProjectRepository::class, \angularavel\Repositories\ProjectRepositoryEloquent::class);
        
        $this->app->bind(\angularavel\Repositories\ProjectNoteRepository::class, \angularavel\Repositories\ProjectNoteRepositoryEloquent::class);
        
        $this->app->bind(\angularavel\Repositories\ProjectTaskRepository::class, \angularavel\Repositories\ProjectTaskRepositoryEloquent::class);
    }
}
