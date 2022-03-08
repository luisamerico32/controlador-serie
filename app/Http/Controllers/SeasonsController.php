<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SeasonsController extends Controller
{
    public function index(int $seriesId)
    {
        $series = Serie::find($seriesId);
        $seasons = $series->season;

        return view('seasons.index', compact('seasons', 'series'));
    }
}
