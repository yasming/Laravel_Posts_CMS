<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    
    public function test_login_with_invalid_credentials()
    {
        $this->post('/api/login', [])->assertStatus(401)
                                     ->assertJson(['error' => 'invalid credentials']);

        $this->post('/api/login', [
            'email' => 'teste@email.com'
        ])->assertStatus(401)
          ->assertJson(['error' => 'invalid credentials']);

        $this->post('/api/login', [
            'password' => 'teste@email.com'
        ])->assertStatus(401)
          ->assertJson(['error' => 'invalid credentials']);

        $this->post('/api/login', [
            'email'    => 'teste@email.com',
            'password' => 'teste@email.com'
        ])->assertStatus(401)
          ->assertJson(['error' => 'invalid credentials']);
    }

    public function test_should_not_allow_access_route()
    {
        $this->post('/api/posts')->assertStatus(401);

    }

    public function test_should_be_able_to_auth_an_user()
    {
        $user     = User::find(1);
        $response = $this->post('/api/login', [
            'email'    => 'email@example.com', 
            'password' => 'password'
        ])->assertStatus(200);

        $response->assertExactJson([
                                        'user' => [ 
                                            "id"                => 1,
                                            "name"              => $user->name,
                                            "email"             => $user->email,
                                            "email_verified_at" => $user->email_verified_at,
                                            "created_at"        => $user->created_at,
                                            "updated_at"        => $user->updated_at,
                                        ],
                                        'token' => $response['token']
                                  ]);

    }
}
