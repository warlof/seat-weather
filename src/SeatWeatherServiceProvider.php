<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 21/04/2017
 * Time: 22:52
 */

namespace Warlof\Seat\SeatWeather;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Warlof\Seat\SeatWeather\Commands\UpdateChecker;

class SeatWeatherServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->addCommands();
        $this->addRoutes();
        $this->addViews();
        $this->addTranslations();
    }

    private function addCommands()
    {
        $this->commands([
            UpdateChecker::class
        ]);
    }

    private function addRoutes()
    {
        if (!$this->app->routesAreCached())
            include __DIR__ . '/Http/routes.php';
    }

    private function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'seat-weather');
    }

    private function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'seat-weather');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/seat-weather.config.php', 'seat-weather.config'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/Config/seat-weather.sidebar.php', 'package.sidebar'
        );
    }
}