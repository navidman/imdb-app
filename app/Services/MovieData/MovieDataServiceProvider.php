<?php


namespace App\Services\MovieData;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MovieDataServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('movieData', function() {
            return App::make('App\Services\MovieData\MovieDataService');
        });
    }

    public function boot()
    {
        //
    }
}
