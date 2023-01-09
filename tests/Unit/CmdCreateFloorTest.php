<?php

namespace Tests\Unit;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdCreateFloorTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $building = Building::factory()->create();

        $this->artisan('create:floor')
            ->expectsQuestion('For which building do you want to create a floor?', 123123)
            ->expectsOutput('No valid building id given.')
            ->assertExitCode(1);

        $this->artisan('create:floor')
            ->expectsQuestion('For which building do you want to create a floor?', $building->id)
            ->expectsQuestion('What is the name of the floor?','testfloor')
            ->expectsOutput('Floor created')
            ->assertSuccessful();
    }
}
