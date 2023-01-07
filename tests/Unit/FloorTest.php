<?php

namespace Tests\Unit;

use App\Models\Floor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FloorTest extends TestCase
{

    use RefreshDatabase;

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
