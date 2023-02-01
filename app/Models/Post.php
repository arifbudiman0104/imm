<?php

namespace App\Models;

use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'published_at',
        'user_id',
        'category_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    protected $hidden = [
        'is_requested',
        'is_rejected',
    ];

    protected $with = [
        'user',
        'post_category',
        // 'comments',
    ];

    public function incrementViewCount() {
        $this->views++;
        return $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
