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
    use RefreshDatabase;


    /**
     * Test login with temporary user.
     *
     * @return void
     */
    public function test_successful_login()
    {
        DB::table('users')->insert([
            'name' => 'apitest',
            'email' => 'apitest@test.ch',
            'password' => bcrypt('12345678'),
            'auth_token' => 0
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'apitest',
            'email' => 'apitest@test.ch',
        ]);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST','/api/login', [
                'email' => 'apitest@test.ch',
                'password' => '12345678'
            ])
            ->assertStatus(201);
    }


    /**
     * Test login without a registered user.
     *
     * @return void
     */
    public function test_unsuccessful_login()
    {
        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST','/api/login', [
                'email' => 'apitest@test.ch',
                'password' => '12345678'
            ])
            ->assertStatus(401);
    }


    /**
     * Test protected routes with authentication.
     *
     * @return void
     */
    public function test_routes_with_authentication()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->withHeaders(['Accept' => 'application/json'])
            ->get('/api/buildings')
            ->assertOk();

        $this->withHeaders(['Accept' => 'application/json'])
            ->get('/api/buildings/1/floors')
            ->assertOk();

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->post('/api/views')
            ->assertStatus(422);
    }


    /**
     * Test protected routes without authentication.
     *
     * @return void
     */
    public function test_routes_without_authentication()
    {
        $this->withHeaders(['Accept' => 'application/json'])->get('/api/buildings')
            ->assertStatus(401);

        $this->withHeaders(['Accept' => 'application/json'])->get('/api/buildings/1/floors')
            ->assertStatus(401);

        $this->withHeaders(['Accept' => 'application/json'])->post('/api/views')
            ->assertStatus(401);
    }


    /**
     * Test resource not found.
     *
     * @return void
     */
    public function test_resource_not_found()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->get('/api')
            ->assertStatus(404);

        $this->get('/api/test')
            ->assertStatus(404);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/views', [
                'name' => 'rolex-mensa',
                'building_id' => '1',
                'floor_id' => '1',
                'view' => "{\"html\": \"html\"}"
            ])
            ->assertStatus(404);

        DB::table('buildings')->insert([
            'name' => 'SIPBB'
        ]);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/views', [
                'name' => 'rolex-mensa',
                'building_id' => '1',
                'floor_id' => '1',
                'view' => "{\"html\": \"html\"}"
            ])
            ->assertStatus(404);

        $this->withHeaders(['Accept' => 'application/json'])->get('/api/buildings/t/floors')
            ->assertStatus(404);
    }


    /**
     * Test with wrong request method.
     *
     * @return void
     */
    public function test_method_not_allowed()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->get('/api/login')
            ->assertStatus(405);

        $this->post('/api/buildings')
            ->assertStatus(405);

        $this->post('/api/buildings/1/floors')
            ->assertStatus(405);

        $this->get('/api/views')
            ->assertStatus(405);
    }


    /**
     * Test response-headers.
     *
     * @return void
     */
    public function test_response_headers()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->get('/api/buildings')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertHeader('Content-Security-Policy', 'frame-ancestors \'none\'')
            ->assertHeader('Strict-Transport-Security', 'max-age=31536000')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('X-Content-Type-Options', 'nosniff');

    }


    /**
     * Test check for content-header.
     *
     * @return void
     */
    public function test_without_content_header()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login')
            ->assertStatus(415);

        $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/views')
            ->assertStatus(415);
    }


    /**
     * Test check for accept-header.
     *
     * @return void
     */
    public function test_without_accept_header()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->withHeaders(['Content-Type' => 'application/json'])
            ->post('/api/login')
            ->assertStatus(400);

        $this->get('/api/buildings')
            ->assertStatus(400);

        $this->get('/api/buildings/1/floors')
            ->assertStatus(400);

        $this->withHeaders(['Content-Type' => 'application/json'])
            ->post('/api/views')
            ->assertStatus(400);
    }


    /**
     * Test bad formed request body.
     *
     * @return void
     */
    public function test_bad_formed_request_body()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/login', [
                'emaill' => 'apitest@test.ch',
                'passwordd' => '12345678'
            ])
            ->assertStatus(422);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/views', [
                'name' => 'rolex-mensa',
                'building_id' => '1',
                'floor_idd' => '1',
                'vieww' => "{\"html\": \"html\"}"
            ])
            ->assertStatus(422);
    }


    /**
     * Test access to publisher data.
     *
     * @return void
     */
    public function test_publisher_data_access()
    {
        $user = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        DB::table('buildings')->insert([
            'id' => 1,
            'name' => 'SIPBB'
        ]);

        DB::table('floors')->insert([
            'id' => 1,
            'name' => 'S250',
            'building_id' => 1
        ]);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/views', [
                'name' => 'rolex-mensa',
                'building_id' => '1',
                'floor_id' => '1',
                'view' => "{\"html\": \"html\"}"
            ])
            ->assertStatus(403);

        DB::table('publisher_data')->insert([
            'id' => 1,
            'name' => 'rolex-mensa',
            'building_id' => 1,
            'floor_id' => 1
        ]);

        DB::table('accesses')->insert([
            'id' => 1,
            'user_id' => $user->id,
            'publisher_data_id' => 1,
            'creates' => 0,
            'reads' => 0,
            'updates' => 1,
            'deletes' => 0,
            'subscribes' => 0
        ]);

        $this->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->json('POST', '/api/views', [
                'name' => 'rolex-mensa',
                'building_id' => '1',
                'floor_id' => '1',
                'view' => "{\"html\": \"html\"}"
            ])
            ->assertStatus(201);
    }


    /**
     * Test throttling.
     *
     * @return void
     */
    public function test_throttling()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        for ($i = 0; $i < 7; $i++) {
            $response = $this->withHeaders(['Accept' => 'application/json'])
                ->post('/api/login');
        }
        $response->assertStatus(429);

        for ($i = 0; $i < 61; $i++) {
            $response = $this->withHeaders(['Accept' => 'application/json'])
                ->get('/api/buildings');
        }
        $response->assertStatus(429);

    }
}
