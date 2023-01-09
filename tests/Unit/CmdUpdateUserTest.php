<?php

namespace Tests\Unit;


use App\Models\HasRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdUpdateUserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $hasRole = HasRole::factory()->create();
        $roles = Role::factory()->count(2)->create();

        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', -1)
            ->expectsOutput('No valid user id given')
            ->assertExitCode(1);

        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', $user->id)
            ->expectsQuestion('You want to change his name? y/n', 'y')
            ->expectsQuestion("What's his new name?", 'newName')
            ->expectsQuestion('You want to change his mail? y/n', 'y')
            ->expectsQuestion("What's his new mail?", 'newMail')
            ->expectsQuestion('You want to change his password? y/n', 'y')
            ->expectsQuestion("What's his new password?", 'newPass')
            ->expectsQuestion('You want to change his duration? y/n', 'y')
            ->expectsQuestion("What's his new duration?", 15)
            ->expectsQuestion('You want to change or add his roles? y/n', 'n')
            ->expectsOutput('User adjusted!')
            ->assertSuccessful();

        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', $user->id)
            ->expectsQuestion('You want to change his name? y/n', 'y')
            ->expectsQuestion("What's his new name?", 'newName')
            ->expectsQuestion('You want to change his mail? y/n', 'y')
            ->expectsQuestion("What's his new mail?", 'newMail')
            ->expectsQuestion('You want to change his password? y/n', 'y')
            ->expectsQuestion("What's his new password?", 'newPass')
            ->expectsQuestion('You want to change his duration? y/n', 'y')
            ->expectsQuestion("What's his new duration?", 15)
            ->expectsQuestion('You want to change or add his roles? y/n', 'y')
            ->expectsQuestion('You want to change one of his userroles? y/n', 'y')
            ->expectsQuestion('Which role u want to change? id', 33)
            ->expectsOutput('No valid role id given')
            ->assertExitCode(1);

        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', $user->id)
            ->expectsQuestion('You want to change his name? y/n', 'y')
            ->expectsQuestion("What's his new name?", 'newName')
            ->expectsQuestion('You want to change his mail? y/n', 'y')
            ->expectsQuestion("What's his new mail?", 'newMail2')
            ->expectsQuestion('You want to change his password? y/n', 'y')
            ->expectsQuestion("What's his new password?", 'newPass')
            ->expectsQuestion('You want to change his duration? y/n', 'y')
            ->expectsQuestion("What's his new duration?", 15)
            ->expectsQuestion('You want to change or add his roles? y/n', 'y')
            ->expectsQuestion('You want to change one of his userroles? y/n', 'y')
            ->expectsQuestion('Which role u want to change? id', $hasRole->id)
            ->expectsQuestion('Which role should it be? id', 66)
            ->expectsOutput('No valid role id given')
            ->assertExitCode(1);

        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', $user->id)
            ->expectsQuestion('You want to change his name? y/n', 'y')
            ->expectsQuestion("What's his new name?", 'newName')
            ->expectsQuestion('You want to change his mail? y/n', 'y')
            ->expectsQuestion("What's his new mail?", 'newMail3')
            ->expectsQuestion('You want to change his password? y/n', 'y')
            ->expectsQuestion("What's his new password?", 'newPass')
            ->expectsQuestion('You want to change his duration? y/n', 'y')
            ->expectsQuestion("What's his new duration?", 15)
            ->expectsQuestion('You want to change or add his roles? y/n', 'y')
            ->expectsQuestion('You want to change one of his userroles? y/n', 'y')
            ->expectsQuestion('Which role u want to change? id', $hasRole->id)
            ->expectsQuestion('Which role should it be? id', $roles[1]->id)
            ->expectsQuestion('You want to add a role? y/n', 'y')
            ->expectsQuestion('What is the users role?', 99)
            ->expectsOutput('No valid role id given')
            ->assertExitCode(1);

        $user2 = User::factory()->create();
        $role2 = Role::factory()->create();
        $this->artisan('update:user')
            ->expectsQuestion('Which user u want to change?', $user2->id)
            ->expectsQuestion('You want to change his name? y/n', 'y')
            ->expectsQuestion("What's his new name?", 'newName')
            ->expectsQuestion('You want to change his mail? y/n', 'y')
            ->expectsQuestion("What's his new mail?", 'newMail')
            ->expectsQuestion('You want to change his password? y/n', 'y')
            ->expectsQuestion("What's his new password?", 'newPass')
            ->expectsQuestion('You want to change his duration? y/n', 'y')
            ->expectsQuestion("What's his new duration?", 15)
            ->expectsQuestion('You want to change or add his roles? y/n', 'y')
            ->expectsQuestion('You want to change one of his userroles? y/n', 'y')
            ->expectsQuestion('Which role u want to change? id', $hasRole->id)
            ->expectsQuestion('Which role should it be? id', $roles[0]->id)
            ->expectsQuestion('You want to add a role? y/n', 'y')
            ->expectsQuestion('What is the users role?', $role2->id)
            ->expectsOutput('User adjusted!')
            ->assertSuccessful();
    }
}
