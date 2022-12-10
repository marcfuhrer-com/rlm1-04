<?php

namespace Tests\Unit;

use App\Models\HasRole;
use Tests\TestCase;

class HasRoleTest extends TestCase
{
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
