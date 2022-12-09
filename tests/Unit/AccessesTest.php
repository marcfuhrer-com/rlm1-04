<?php

namespace Tests\Unit;

use App\Models\Accesses;
use Tests\TestCase;

class AccessesTest extends TestCase
{
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
