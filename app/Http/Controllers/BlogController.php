<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Inertia\Inertia;

class BlogController extends Controller
{
    public function __construct()
    {
        Inertia::setRootView('blog');
    }
    
    public function index()
    {
        $posts = Post::with('user:id,name')->with('categories:slug,name')->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }
}
