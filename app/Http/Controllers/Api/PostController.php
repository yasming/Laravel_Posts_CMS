<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Resources\PostCollection;
use App\Models\Post;
class PostController extends Controller
{
    public function index() 
    {
        return new PostCollection(Post::searchByTag());
    }

    public function store(StorePost $request) 
    {
        $post = Post::create($request->validated());
        return response()->json($post,201);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([],204);
    }
}
