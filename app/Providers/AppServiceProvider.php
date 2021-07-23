<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Ahex\Entrada\Application\Printing\PrintingContainer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Observers
        \App\Entrada::observe(\App\Observers\EntradaObserver::class);
        \App\EntradaEtapa::observe(\App\Observers\EntradaEtapaObserver::class);
        \App\Salida::observe(\App\Observers\SalidaObserver::class);
        \App\SalidaIncidente::observe(\App\Observers\SalidaIncidenteObserver::class);

        // Composers
        View::composer('entradas.index', function ($view) {
            View::share('clientes', \App\Cliente::all());
            View::share('etapas', \App\Etapa::all());
        });

        View::composer(['entradas.index','entradas.show','consolidados.show'], function ($view) {
            View::share('printing_sheets', PrintingContainer::sheets());
        });

        // Global
        View::share('symbols', config('resources.symbols'));
        View::share('svg', config('resources.bootstrap-svg'));
        View::share('icons', config('resources.bootstrap-icons'));
    }
}
