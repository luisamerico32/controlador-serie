<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesCreatorTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarSerie()
    {
        $seriesCreator = new SeriesCreator();
        $nameSeries = 'Nome de teste';
        $seriesCreated = $seriesCreator->createSerie($nameSeries, 1, 1);

        $this->assertInstanceOf(Serie::class, $seriesCreated);
        $this->assertDatabaseHas('series', ['name' => $nameSeries]);
        $this->assertDatabaseHas('seasons', ['serie_id' => $seriesCreated->id, 'number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
