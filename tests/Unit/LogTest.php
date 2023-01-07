<?php

namespace Tests\Unit;

use App\Models\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $log = Log::factory()->create();
        $this->assertNotNull($log);
        $log->delete();
        $this->assertDeleted($log);
    }
}
