<?php

namespace Tests\Unit;

use App\Models\Floor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteFloorTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $floor = Floor::factory()->count(5)->create();

        $this->artisan('delete:floor')
            ->expectsQuestion('Which floor do u want to delete?', 11)
            ->expectsOutput('No valid floor id given')
            ->assertExitCode(1);

        $this->artisan('delete:floor')
            ->expectsQuestion('Which floor do u want to delete?', $floor[0]->id)
            ->expectsOutput('Floor deleted.')
            ->assertSuccessful();
    }
}
