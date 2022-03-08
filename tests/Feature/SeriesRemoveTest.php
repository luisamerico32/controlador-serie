<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use App\Services\SeriesRemove;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRemoveTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $series;

    protected function setUp(): void
    {
        parent::setUp();
        $seriesCreator = new SeriesCreator();
        $this->series = $seriesCreator->createSerie('Nome da série', 1, 1);
    }

    public function testRemoveSeries()
    {
        $this->assertDatabaseHas('series', ['id' => $this->series->id]);
        $seriesRemove = new SeriesRemove();
        $seriesName = $seriesRemove->removeSeries($this->series->id);
        $this->assertIsString($seriesName);
        $this->assertEquals('Nome da série', $this->series->name);
        $this->assertDatabaseMissing('series', ['id' => $this->series->id]);
    }
}
