<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggingTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $logs_count_old = count(\App\Models\Log::all());
        $user = User::factory()->create();
        Log::debug('debug_test', array('user' => $user->id));
        Log::warning('warn_test', array('user' => $user->id));
        Log::notice('notice_test', array('user' => $user->id));
        Log::info('info_test', array('user' => $user->id));
        Log::error('error_test', array('user' => $user->id));
        Log::critical('critical_test', array('user' => $user->id));
        Log::emergency('emergency_test', array('user' => $user->id));
        $logs_count_new = count(\App\Models\Log::all());
        $this->assertEquals($logs_count_old+7, $logs_count_new);
        $user->delete();

    }
}
