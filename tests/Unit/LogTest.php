<?php

namespace Tests\Unit;

use App\Models\Log;
use Tests\TestCase;

class LogTest extends TestCase
{
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
