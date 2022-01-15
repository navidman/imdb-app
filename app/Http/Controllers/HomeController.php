<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\MovieData\MovieData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $movie_repository;

    public function __construct(MovieRepositoryInterface $movie_repository)
    {
        $this->movie_repository = $movie_repository;
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $movie = $this->movie_repository->store($input);
        return $this->get($movie->url);
    }
    public function get($url)
    {
        return MovieData::getInfo($url);

    }
}

