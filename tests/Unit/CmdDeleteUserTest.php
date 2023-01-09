<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteUserTest extends TestCase
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

        $this->artisan('delete:user')
            ->expectsQuestion('Which user u want to delete?', 11)
            ->expectsOutput('No valid user id given')
            ->assertExitCode(1);

        $this->artisan('delete:user')
            ->expectsQuestion('Which user u want to delete?', $users[0]->id)
            ->expectsOutput('User deleted.')
            ->assertSuccessful();
    }
}
