<?php

namespace Tests\Unit;

use App\Models\PublisherData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdDeletePublisherDataTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $pubData = PublisherData::factory()->count(5)->create();

        $this->artisan('delete:publisherdata')
            ->expectsQuestion('For which set do you want to clear all data?', 'test')
            ->expectsOutput('No data exists for given name')
            ->assertExitCode(1);

        $this->artisan('delete:publisherdata')
            ->expectsQuestion('For which set do you want to clear all data?', $pubData[1]->name)
            ->expectsOutput('Data cleared for name ' . $pubData[1]->name)
            ->assertSuccessful();
    }
}
