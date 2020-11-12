<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
class PostController extends Controller
{
    public function index() 
    {
        return new PostCollection(Post::searchByTag());
    }

    public function store() 
    {
        return response()->json(200);
    }
}
