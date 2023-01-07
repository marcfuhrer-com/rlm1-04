<?php

namespace Tests\Unit;

use App\Models\PublisherData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublisherDataTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $publisherData = PublisherData::factory()->create();
        $this->assertNotNull($publisherData);
        $publisherData->delete();
        $this->assertDeleted($publisherData);
    }
}
