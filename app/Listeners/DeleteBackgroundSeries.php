<?php

namespace App\Listeners;

use App\Events\EventDeletedSeries;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeleteBackgroundSeries implements ShouldQueue
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
     * @param  \App\Events\EventDeletedSeries  $event
     * @return void
     */
    public function handle(EventDeletedSeries $event)
    {
        $series = $event->series;

        if ($series->background) {
            Storage::delete($series->background);
        }
    }
}
