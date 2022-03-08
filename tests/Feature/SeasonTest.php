<?php

namespace Tests\Feature;

use App\Models\Episode;
use App\Models\Season;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    private $season;

    protected function setUp(): void
    {
        parent::setUp();
        $season = new Season();
        $episode1 = new Episode();
        $episode1->watched = true;
        $episode2 = new Episode();
        $episode2->watched = false;
        $episode3 = new Episode();
        $episode3->watched = true;
        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }

    public function testBuscaPorEpisodiosAssistidos()
    {
        $episodesWatched = $this->season->getEpisodesWatched();
        $this->assertCount(2, $episodesWatched);

        foreach ($episodesWatched as $episode) {
            $this->assertTrue($episode->watched);
        }
    }

    public function testBuscaTodosEpisodios()
    {
        $episodes = $this->season->episodes;
        $this->assertCount(3, $episodes);
    }
}
