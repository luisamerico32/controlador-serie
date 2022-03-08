<?php

namespace App\Services;

use App\Events\EventDeletedSeries;
use App\Jobs\DeleteBackgroundSeries;
use App\Models\{Episode, Season, Serie};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SeriesRemove
{
    public function removeSeries(int $seriesId): string
    {
        $nameSeries = '';
        DB::transaction( function () use ($seriesId, &$nameSeries) {
            $series = Serie::find($seriesId);
            $seriesObj = (object) $series->toArray();

            $nameSeries = $series->name;

            $this->removeSeasons($series);
            $series->delete();

            $event = new EventDeletedSeries($seriesObj);
            event($event);

            DeleteBackgroundSeries::dispatch($seriesObj);
        });

        return $nameSeries;
    }

    /**
     * @param $series
     * @return void
     */
    private function removeSeasons(Serie $series): void
    {
        $series->season->each(function (Season $season) {
            $this->removeEpisodes($season);
            $season->delete();
        });
    }

    /**
     * @param Season $season
     * @return void
     */
    private function removeEpisodes(Season $season): void
    {
        $season->episodes->each(function (Episode $episode) {
            $episode->delete();
        });
    }
}
