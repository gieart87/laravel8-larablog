<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    public const DRAFT = 0;
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    
    public const POST = 'Post';
    public const PAGE = 'Page';

    public const STATUSES = [
        self::DRAFT => 'draft',
        self::ACTIVE => 'active',
        self::INACTIVE => 'inactive',
    ];

    public $casts = [
        'published_at' => 'datetime:d, M Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function scopeActivePost($query)
    {
        return $query->where('status', self::ACTIVE)
            ->where('post_type', self::POST)
            ->where('published_at', '<=', Carbon::now());
    }

    public function getNextPostAttribute()
    {
        $nextPost = self::activePost()
            ->where('published_at', '>', $this->published_at)
            ->orderBy('published_at', 'asc')
            ->first();
        
        return $nextPost;
    }

    public function getPrevPostAttribute()
    {
        $prevPost = self::activePost()
            ->where('published_at', '<', $this->published_at)
            ->orderBy('published_at', 'desc')
            ->first();
        
        return $prevPost;
    }
}
