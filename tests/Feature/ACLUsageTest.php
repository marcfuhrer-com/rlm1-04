<?php

namespace Tests\Feature;

use App\Models\Accesses;
use App\Models\HasRole;
use App\Models\PublisherData;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Tests\TestCase;

class ACLUsageTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user()
    {
        $this->seed();
        $user = new User();
        $user->name = 'testuser';
        $user->email = 'user@mail.ch';
        $user->password = Hash::make('123');
        $user->save();
        $hasRole = new HasRole();
        $hasRole->role_id = 5;
        $hasRole->user_id = $user->id;
        $hasRole->save();

        $response = $this->actingAs($user)->get('/usage');
        $response->assertStatus(200);
        $response->assertSee('You are no publisher.');
        $user->delete();
        $hasRole->delete();
    }

    public function test_admin()
    {
        $pubData = PublisherData::factory()->count(5)->create();
        $role = new Role();
        $role->name = "Service Administrator";
        $role->save();
        $user = new User();
        $user->name = 'testadmin';
        $user->email = 'admin@mail.ch';
        $user->password = Hash::make('123');
        $user->save();
        $hasRole = new HasRole();
        $hasRole->role_id = $role->id;
        $hasRole->user_id = $user->id;
        $hasRole->save();

        $response = $this->actingAs($user)->get('/usage');
        $response->assertStatus(200);
        $response->assertSee('Stats for entry');
        $user->delete();
        $hasRole->delete();
    }

    public function test_publisher()
    {
        $role = new Role();
        $role->name = "Publisher";
        $role->save();
        $user = new User();
        $user->name = 'testpublisher';
        $user->email = 'publisher@mail.ch';
        $user->password = Hash::make('123');
        $user->save();
        $hasRole = new HasRole();
        $hasRole->role_id = $role->id;
        $hasRole->user_id = $user->id;
        $hasRole->save();

        $response = $this->actingAs($user)->get('/usage');
        $response->assertStatus(200);
        $response->assertSee('is currently subscribed');
        $user->delete();
        $hasRole->delete();
    }
}
