<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
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
        return response()->json(new PostResource($post),201);
    }

    public function update(StorePost $request, Post $post) 
    {
        $post->update($request->validated());
        return response()->json(new PostResource($post),200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([],204);
    }
}
