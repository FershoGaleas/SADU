<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SalaEspera;



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
        View::composer('layouts.navigation', function ($view) {
            if(auth()->check() && auth()->user()->rol === 'admin') {
                $conteoSala = SalaEspera::where('id_user', auth()->id())->count();
                $view->with('conteoSala', $conteoSala);
            }
        });


    }
}
