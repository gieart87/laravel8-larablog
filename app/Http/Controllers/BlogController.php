<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

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
        $posts = Post::activePost()
            ->with('user:id,name')
            ->with('categories:slug,name')
            ->orderBy('published_at', 'desc')
            ->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::activePost()
            ->with('user:id,name')
            ->with('categories:slug,name')
            ->with('tags:slug,name')
            ->where('slug', $slug)
            ->firstOrFail();

        return Inertia::render('Blog/Show', [
            'post' => $post,
            'nextPost' => $post->next_post,
            'prevPost' => $post->prev_post,
        ]);
    }

    public function user($userId)
    {
        $posts = Post::activePost()
            ->where('user_id', $userId)
            ->with('user:id,name')
            ->with('categories:slug,name')
            ->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }

    public function category($slug)
    {
        $posts = Post::activePost()
            ->whereHas('categories', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->with('user:id,name')
            ->with('categories:slug,name')
            ->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }

    public function tag($slug)
    {
        $posts = Post::activePost()
            ->whereHas('tags', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->with('user:id,name')
            ->with('categories:slug,name')
            ->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }
}
