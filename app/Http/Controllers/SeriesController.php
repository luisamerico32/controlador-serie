<?php

namespace App\Http\Controllers;

use App\Events\EventNewSeries;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\MailNewSeries;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Models\User;
use App\Services\SeriesCreator;
use App\Services\SeriesRemove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('name')
            ->get();

        $message = $request->session()->get('message');

        return view('series.index', compact('series', 'message'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SeriesCreator $seriesCreator)
    {
        $background = null;
        if ($request->hasFile('background')) {
            $background = $request->file('background')->store('series');
        }

        $serie = $seriesCreator->createSerie(
            $request->name,
            $request->seasons,
            $request->episodes,
            $background
        );

        $eventNewSeries = new EventNewSeries(
            $request->name,
            $request->seasons,
            $request->episodes
        );
        event($eventNewSeries);

        $request->session()
            ->flash(
                'message',
                "Série {$serie->name} criada com sucesso!"
            );

        return redirect()->route('list_series');
    }

    public function destroy(Request $request, SeriesRemove $seriesRemove)
    {
        $nameSerie = $seriesRemove->removeSeries($request->id);
        $request->session()
            ->flash(
                'message',
                "Série $nameSerie excluída com sucesso!"
            );

        return redirect()->route('list_series');
    }

    public function editName(int $seriesId, Request $request)
    {
        $newName = $request->name;
        $series = Serie::find($seriesId);
        $series->name = $newName;
        $series->save();
    }
}
