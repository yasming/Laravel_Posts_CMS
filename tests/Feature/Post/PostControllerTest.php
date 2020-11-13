<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $token;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
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

    public function test_it_should_be_able_to_search_post_by_tag()
    {
        $postsWithOrganizationTag = Post::whereJsonContains('tags', 'organization')->get();
        $postsForJson             = new PostCollection($postsWithOrganizationTag);
        $response                 = $this->get('/api/posts?tag=organization', ['Authorization' => "Bearer ".$this->token])
                                         ->assertStatus(200);

        $this->assertEquals($postsForJson->response()->getData(true)['data'],$response['data']);
        $this->assertEquals(count($response['data']), $postsWithOrganizationTag->count());
    }

    public function test_it_should_be_able_to_validate_fields_to_create_post()
    {
        $this->withHeaders(['Authorization' => "Bearer ".$this->token])
             ->json('POST', '/api/posts')
             ->assertStatus(422)
             ->assertExactJson([
                            'tags'    => ['The tags field is required.'],
                            'content' => ['The content field is required.'],
                            'title'   => ['The title field is required.'],
                            'author'  => ['The author field is required.']
                          ]);

        $this->withHeaders(['Authorization' => "Bearer ".$this->token])
             ->json('POST', '/api/posts',[
                                            'tags'    => 'test'
                                        ])
             ->assertStatus(422)
             ->assertExactJson([
                            'content' => ['The content field is required.'],
                            'tags'    => ['The tags must be an array.'],
                            'title'   => ['The title field is required.'],
                            'author'  => ['The author field is required.']
                         ]);

        $this->withHeaders(['Authorization' => "Bearer ".$this->token])
             ->json('POST', '/api/posts',[
                                            'content' => ['test'],
                                            'title'   => ['test'],
                                            'author'  => ['test'],
                                            'tags'    => ['authorization']
                                        ])
             ->assertStatus(422)
             ->assertExactJson([
                            'content' => ['The content must be a string.'],
                            'title'   => ['The title must be a string.'],
                            'author'  => ['The author must be a string.']
                         ]);

    }

    public function test_it_should_be_able_to_able_to_create_a_post()
    {
        $this->withHeaders(['Authorization' => "Bearer ".$this->token])
             ->json('POST', '/api/posts',[
                                                'content' => 'test',
                                                'title'   => 'test',
                                                'author'  => 'test',
                                                'tags'    => ['authorization']
                                        ])
             ->assertStatus(201)
             ->assertJson([
                            'content' => 'test',
                            'title'   => 'test',
                            'author'  => 'test',
                            'tags'    => ['authorization'],
                         ]);

    }

    public function test_it_should_be_able_to_delete_a_post()
    {
        $response = $this->withHeaders(['Authorization' => "Bearer ".$this->token])
                         ->json('DELETE', '/api/posts/1')
                         ->assertStatus(204);
    
        $this->assertEquals($response->getData(true),[]);
        $this->assertEquals(Post::find(1), null);
    }
}
