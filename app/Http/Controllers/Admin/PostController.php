<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Services\AdminServiceInterface;
use Illuminate\Http\Request;
use Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $service;

    public function __construct(AdminServiceInterface $service) {
//        $this->authorizeResource(Post::class, 'post');
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::with('author')->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::with('children')->whereNull('parent_id')->get(),
            'delimiter' => '',
            'images' => Image::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $this->service->create($request->all());

        return redirect()->route('admin.posts.edit', $post)->withSuccess(__('Posts created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'user' => $post->author,
            'images' => Image::get(),
            'thumbnail' => $post->image,
            'categories' => Category::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post = $this->service->update($request->only(['title', 'content', 'author_id', 'categories', 'thumbnail_id', 'thumbnail_name', 'status']) + ['post' => $post]);

        return redirect()->route('admin.posts.edit', $post)->withSuccess(__('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->withSuccess(__('posts.deleted'));
    }
}
