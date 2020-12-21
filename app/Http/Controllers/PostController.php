<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name')
            ->with('categories:slug,name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return Inertia::render('Posts/Create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => [
                'required',
                'string'
            ],
            'body' => [
                'string'
            ],
            'category_ids' => [
                'required',
                'array',
                'min:2',
            ],
            'tags' => [
                'string'
            ],
        ])->validate();

        $params = $request->all();
        $params['slug'] = Str::slug($params['title']);
        $params['user_id'] = $request->user()->id;
        $params['post_type'] = Post::POST;
        $params['status'] = Post::DRAFT;
        
        $tags = explode(',', $params['tags']);
        $tagIds = [];
        foreach ($tags as $tag) {
            $itemTag = Tag::where('name', trim($tag))->first();

            if (!$itemTag) {
                $itemTag = Tag::create(['name' => trim($tag), 'slug' => Str::slug(trim($tag))]);
            }

            $tagIds[] = $itemTag->id;
        }

        $post = Post::create($params);
        $post->categories()->attach($params['category_ids']);
        $post->tags()->attach($tagIds);

        return redirect('/posts')->with('message', 'Post created successfully.');
    }
}
