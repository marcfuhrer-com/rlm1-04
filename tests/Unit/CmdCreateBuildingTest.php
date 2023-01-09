<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdCreateBuildingTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->artisan('create:building')
            ->expectsQuestion('What is the name of the building?', 'test')
            ->expectsOutput('Building created')
            ->assertSuccessful();
    }
}
