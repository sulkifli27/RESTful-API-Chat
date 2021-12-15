<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function test_RequireSendMessage()
    {
        $user = User::factory()->create([
            'email' => 'sul@gamil.com',
            'password' => bcrypt('12345678'),
        ]);

        $token = $user->createToken('nApp')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $payload = [
            'message' => '',
        ];

        $error["message"] = ["The message field is required."];

        $this->json('POST', 'api/send/chat/2', $payload, $headers, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                "status" => "error",
                "message" => $error
            ]);
    }

    public function test_SuccesSendMessage()
    {
        $user = User::factory()->create([
            'email' => 'sul@gamil.com',
            'password' => bcrypt('12345678'),
        ]);

        $token = $user->createToken('nApp')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $payload = [
            "sender_id" => 1,
            "receiver_id" => 2,
            'message' => 'Hallo'
        ];

        $this->withoutExceptionHandling();


        $this->json('POST', 'api/send/chat/2', $payload, $headers, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);
    }
}
