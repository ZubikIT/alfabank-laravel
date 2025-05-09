<?php

namespace SniffRx\AlfaBank;

use Illuminate\Support\ServiceProvider;

class AlfaBankServiceProvider extends ServiceProvider
{
    /**
     * Регистрация службы
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/alfabank.php','alfabank');

        $this->app->singleton(AlfaBankService::class, function ($app) {
            return new AlfaBankService();
        });
    }

    /**
     * Bootstrap всех служб пакета.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/alfabank.php' => config_path('alfabank.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->commands([]);
        }
    }
}
