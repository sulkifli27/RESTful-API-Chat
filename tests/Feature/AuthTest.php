<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    // use DatabaseTransactions;
    use RefreshDatabase;

    public function test_UserErrorLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(401)
            ->assertJson([
                'error' => "Unauthorized",
            ]);
    }

    public function test_UserLoginSuccess()
    {
        $user = User::factory()->create([
            'email' => 'sul@gamil.com',
            'password' => bcrypt('12345678'),
        ]);

        $body = ['email' => 'sul@gamil.com', 'password' => '12345678'];
        $this->json('POST', 'api/login', $body)
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "code" => 200,
            ]);
    }
}
