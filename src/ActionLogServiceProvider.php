<?php

namespace Virtualorz\ActionLog;

use Illuminate\Support\ServiceProvider;

class ActionLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('actionLog',function(){
            return new ActionLog();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadMigrationsFrom(__DIR__.'migrations');
        $this->publishes([
            __DIR__.'/migrations' => base_path('database/migrations/virtualorz/actionLog'),
        ]);
    }
}
