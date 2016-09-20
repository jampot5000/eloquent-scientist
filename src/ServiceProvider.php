<?php
/**
 * Created by PhpStorm.
 * User: jholc
 * Date: 20/09/16
 * Time: 1:13
 */

namespace Jampot5000\EloquentScientist;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Scientist\Laboratory;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->publishes([
            __DIR__.'/config.php' => config_path('scientist.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'scientist'
        );

        $this->app->singleton(['Scientist\Laboratory', Laboratory::class], function () {
            $lab = new Laboratory;
            foreach (config('scientist.reporters') as $reporter)
            {
                $lab->addJournal(new $reporter);
            }
            return $lab;
        });
    }
}