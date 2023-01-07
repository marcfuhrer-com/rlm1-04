<?php

namespace Tests\Unit;

use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $role = Role::factory()->create();
        $this->assertNotNull($role);
        $role->delete();
        $this->assertDeleted($role);
    }
}
