<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show the main page.
     */
    public function index(Request $request): View
    {
        return view('site.posts.index', [
            'posts' => Post::with('categories')
                ->whereStatus(1)
                ->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('site.posts.show', [
            'post' => $post->load('image')
        ]);
    }
}
