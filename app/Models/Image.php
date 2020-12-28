<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'original',
        'large',
        'medium',
        'small',
    ];

    public const UPLOAD_FOLDER = 'uploads/posts';
    public const SMALL = '135x141';
	public const MEDIUM = '312x400';
	public const LARGE = '1000x600';

    public function imageable()
    {
        return $this->morphTo();
    }
}
