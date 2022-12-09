<?php

namespace Tests\Unit;

use App\Models\Floor;
use Tests\TestCase;

class FloorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $floor = Floor::factory()->create();
        $this->assertNotNull($floor);
        $floor->delete();
        $this->assertDeleted($floor);
    }
}
