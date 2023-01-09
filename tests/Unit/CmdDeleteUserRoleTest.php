<?php

namespace Tests\Unit;

use App\Models\HasRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteUserRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $users = User::factory()->count(5)->create();
        $hasRoles = HasRole::factory()->count(5)->create();

        $this->artisan('delete:userrole')
            ->expectsQuestion('For which user u want to delete a role?', 11)
            ->expectsOutput('No valid user id given')
            ->assertExitCode(1);

        $this->artisan('delete:userrole')
            ->expectsQuestion('For which user u want to delete a role?', $users[0]->id)
            ->expectsQuestion('Which role shall be deleted?', 111)
            ->expectsOutput('No valid role id given')
            ->assertExitCode(1);

        $this->artisan('delete:userrole')
            ->expectsQuestion('For which user u want to delete a role?',  $users[0]->id)
            ->expectsQuestion('Which role shall be deleted?', $hasRoles[0]->id)
            ->expectsOutput('Role deleted.')
            ->assertSuccessful();
    }
}
