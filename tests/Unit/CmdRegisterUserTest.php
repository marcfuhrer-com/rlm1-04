<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdRegisterUserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->artisan('register:user')
            ->expectsQuestion('What is the users name?', 'cmd_testname1')
            ->expectsQuestion('What is the users mail?', 'cmd_mail1')
            ->expectsQuestion('What is the password?', 'cmd_pass1')
            ->expectsQuestion('What is his duration?', 15)
            ->expectsOutput()
            ->expectsQuestion('What is the users role?', 2)
            ->expectsOutput('User created!');
    }
}
