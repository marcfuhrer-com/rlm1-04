<?php

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdCreateUserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $role = Role::factory()->count(5)->create();

        $this->artisan('create:user')
            ->expectsQuestion('What is the users name?', 'cmd_testname1')
            ->expectsQuestion('What is the users mail?', 'cmd_mail1')
            ->expectsQuestion('What is the password?', 'cmd_pass1')
            ->expectsQuestion('What is his duration?', 15)
            //->expectsOutput()
            ->expectsQuestion('What is the users role?', $role[0]->id)
            ->expectsOutput('User created!');

        $this->assertDatabaseHas('users', [
            'email' => 'cmd_mail1',
        ]);
    }
}
