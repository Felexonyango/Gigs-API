<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UsetTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
        /** @test */
    public function test_register_form()
    {
        $this->withoutExceptionHandling();
     
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'

        ]);
        $response->assertOk(200);
    }
    public function test_user_on_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // $this->assertAuthenticated();
        $response->assertOk(200);
    }
}
