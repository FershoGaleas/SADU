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
            if(auth()->check() && (auth()->user()->rol === 'admin' || auth()->user()->rol === 'usuario')) {
                $conteoSala = SalaEspera::where(function($q){
                    $q->where('id_user',auth()->id())
                        ->orwhere('id_enfermera',auth()->id());
                })->count();
                $view->with('conteoSala', $conteoSala);
            }
        });


    }
}
