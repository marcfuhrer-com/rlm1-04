<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdCreateRoleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->artisan('create:role')
            ->expectsQuestion('What is the name of the role?', 'test')
            ->expectsOutput('Role created')
            ->assertSuccessful();
    }
}
