<?php

namespace App\Http\Controllers;

use App\Services\MovieData\MovieData;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{

    public function get()
    {
        return MovieData::getInfo();

    }
}

