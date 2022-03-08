<?php

namespace App\Listeners;

use App\Events\EventNewSeries;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogMailNewSeriesRegistered implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventNewSeries  $event
     * @return void
     */
    public function handle(EventNewSeries $event)
    {
        $nameSeries = $event->name;
        Log::info("Série {$nameSeries} cadastrada");
    }
}
