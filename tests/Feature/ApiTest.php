<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;
use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

class ApiTest extends TestCase
{

    /**
     * Register a test user first.
     *
     * @return void
     */
    /*public function test_registration()
    {
        // Create a new user
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'apitest@test.ch',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        // Test that the user exists in the database
        $this->assertDatabaseHas('users', ['email' => 'apitest@test.ch']);

    }*/

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test login.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'apitest@test.ch',
            'password' => '12345678'
        ]);

        $token = DB::table('personal_access_tokens')
            ->max('id');

        $response->assertStatus(201)
            ->assertJson([
                'email' => 'apitest@test.ch',
                'token' => $token]);
    }

    /**
     * Test authentication middleware.
     *
     * @return void
     */
    public function test_authentication()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get('/api/buildings');
        $response->assertOk();
    }

}
