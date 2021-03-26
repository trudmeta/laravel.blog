<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    /**
     * Return the posts.
     */
    public function index(Request $request): ResourceCollection
    {
        $posts = Post::search($request->input('q'))->get();

        return PostResource::collection($posts);
    }

    /**
     * Return the specified resource.
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }
}
