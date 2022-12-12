<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::factory()->create();
        $this->assertNotNull($user);
        $user->delete();
        $this->assertDeleted($user);
    }
}
