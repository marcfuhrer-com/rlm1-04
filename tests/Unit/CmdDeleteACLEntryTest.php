<?php

namespace Tests\Unit;

use App\Models\Accesses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteACLEntryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $accesses = Accesses::factory()->count(5)->create();

        $this->artisan('delete:acl')
            ->expectsQuestion('Which entry do u want to delete?', 11)
            ->expectsOutput('No valid ACL id given')
            ->assertExitCode(1);

        $this->artisan('delete:acl')
            ->expectsQuestion('Which entry do u want to delete?', $accesses[0]->id)
            ->expectsOutput('ACL deleted.')
            ->assertSuccessful();
    }
}
