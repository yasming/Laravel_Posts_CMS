<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostControllerTest extends TestCase
{
    private $token;
    public function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/login', [
            'email'    => 'email@example.com', 
            'password' => 'password'
        ])->assertStatus(200);
        $this->token = $response['token'];
    }
    
    public function test_it_should_be_able_to_list_all_posts()
    {
        $this->get('/api/posts', ['Authorization' => "Bearer ".$this->token])->assertStatus(200);
    }
}
