<?php


namespace App\Services\MovieData;


use Illuminate\Support\Facades\Facade;

class MovieData extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'movieData';
    }
}
