<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Accesses;
use Tests\TestCase;

class AccessesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $accesses = Accesses::factory()->create();
        $this->assertNotNull($accesses);
        $accesses->delete();
        $this->assertDeleted($accesses);
    }
}
