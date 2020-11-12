<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Resources\PostCollection;
use App\Models\Post;
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
        $allPosts = new PostCollection(Post::all());
        $response = $this->get('/api/posts', ['Authorization' => "Bearer ".$this->token])->assertStatus(200);

        $this->assertEquals($allPosts->response()->getData(true)['data'],$response['data']);
        $this->assertEquals(count($response['data']), Post::all()->count());

    }
}
