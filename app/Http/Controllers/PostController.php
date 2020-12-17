<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name')
            ->with('categories:slug,name')
            ->get();
        
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
}
