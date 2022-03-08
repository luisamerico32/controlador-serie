<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SeriesCreator
{
    public function createSerie(string $seriesName, int $numberSeasons, int $numberEpisodes, ?string $background): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create([
            'name' => $seriesName,
            'background' => $background
        ]);
        $this->createSeasons($numberSeasons, $serie, $numberEpisodes);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $numberSeasons
     * @param $serie
     * @param int $numberEpisodes
     * @return void
     */
    private function createSeasons(int $numberSeasons, $serie, int $numberEpisodes): void
    {
        for ($i = 1; $i <= $numberSeasons; $i++) {
            $season = $serie->season()->create(['number' => $i]);

            $this->createEpisodes($numberEpisodes, $season);
        }
    }

    /**
     * @param int $numberEpisodes
     * @param $season
     * @return void
     */
    private function createEpisodes(int $numberEpisodes, $season): void
    {
        for ($j = 1; $j <= $numberEpisodes; $j++) {
            $season->episodes()->create(['number' => $j]);
        }
    }
}
