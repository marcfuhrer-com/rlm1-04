<?php

namespace Tests\Unit;

use App\Models\PublisherData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmdCreateACLEntryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $users = User::factory()->count(5)->create();
        $pubData = PublisherData::factory()->count(5)->create();

        $this->artisan('create:acl')
            ->expectsQuestion('For which user, do you want do create an access?', 66)
            ->expectsOutput('Wrong user id')
            ->assertExitCode(1);


        $this->artisan('create:acl')
            ->expectsQuestion('For which user, do you want do create an access?', $users[0]->id)
            ->expectsQuestion('For which dataset should he get rights?', 'test')
            ->expectsOutput('Does not exists')
            ->assertExitCode(1);

        $operation = ['0', '2', '4'];

        $this->artisan('create:acl')
            ->expectsQuestion('For which user, do you want do create an access?', $users[0]->id)
            ->expectsQuestion('For which dataset should he get rights?', $pubData[0]->name)
            ->expectsChoice('Which operations shall he be able to do', $operation, ['create', 'read', 'update', 'delete', 'subscribe'])
            ->expectsOutput('ACL entry created')
            ->assertSuccessful();

        $this->artisan('create:acl')
            ->expectsQuestion('For which user, do you want do create an access?', $users[0]->id)
            ->expectsQuestion('For which dataset should he get rights?', $pubData[0]->name)
            ->expectsOutput('ACL entry for user and publisher does already exist. Use update command.')
            ->assertExitCode(1);
    }
}
