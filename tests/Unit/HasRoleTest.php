<?php

namespace Tests\Unit;

use App\Models\HasRole;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasRoleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $hasRole = HasRole::factory()->create();
        $this->assertNotNull($hasRole);
        $hasRole->delete();
        $this->assertDeleted($hasRole);
    }
}
