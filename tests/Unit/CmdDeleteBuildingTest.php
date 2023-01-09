<?php

namespace Tests\Unit;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeleteBuildingTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $buildings = Building::factory()->count(5)->create();

        $this->artisan('delete:building')
            ->expectsQuestion('Which building do u want to delete?', 11)
            ->expectsOutput('No valid building id given')
            ->assertExitCode(1);

        $this->artisan('delete:building')
            ->expectsQuestion('Which building do u want to delete?', $buildings[0]->id)
            ->expectsOutput('Building deleted.')
            ->assertSuccessful();
    }
}
