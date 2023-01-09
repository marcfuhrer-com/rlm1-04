<?php

namespace Tests\Unit;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteRoleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $roles = Role::factory()->count(5)->create();

        $this->artisan('delete:role')
            ->expectsQuestion('Which role do u want to delete?', -1)
            ->expectsOutput('No valid role id given')
            ->assertExitCode(1);

        $this->artisan('delete:role')
            ->expectsQuestion('Which role do u want to delete?', $roles[0]->id)
            ->expectsOutput('Role deleted.')
            ->assertSuccessful();
    }
}
