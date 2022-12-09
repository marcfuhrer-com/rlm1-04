<?php

namespace Tests\Unit;

use App\Models\Building;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $building = Building::factory()->create();
        $this->assertNotNull($building);
        $building->delete();
        $this->assertDeleted($building);
    }
}
