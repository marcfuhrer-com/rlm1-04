<?php

namespace Tests\Unit;

use App\Models\Accesses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdUpdateACLEntryTest extends TestCase
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

        $this->artisan('update:acl')
            ->expectsQuestion('Which entry do you want to update?', -1)
            ->expectsOutput('No valid ACL id given')
            ->assertExitCode(1);

        $operation = ['0', '2', '4'];

        $this->artisan('update:acl')
            ->expectsQuestion('Which entry do you want to update?', $accesses[0]->id)
            ->expectsChoice('Which operations shall he be able to do', $operation, ['create', 'read', 'update', 'delete', 'subscribe'])
            ->expectsOutput('ACL entry updated')
            ->assertSuccessful();
    }
}
