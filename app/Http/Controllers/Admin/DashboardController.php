<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::whereStatus(1)->count();
        $categories = Category::whereStatus(1)->count();
        return view('admin.dashboard.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
