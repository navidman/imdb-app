<?php


namespace App\Repositories;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{


    public function store($data)
    {
        $movie = Movie::create([
            'url' => $data['url'],
        ]);
        return $movie;

    }


}
