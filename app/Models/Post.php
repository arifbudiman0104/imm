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
        'post_category_id',
    ];

    protected $casts = [
        'created_at',
        'updated_at',
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    protected $hidden = [
        'is_requested',
        'is_rejected',
        'is_published',
        'is_approved',
        'is_featured',
        'approved_at',
        'user_id',
        'id',
        'post_category_id',
    ];

    protected $with = [
        // 'user',
        // 'post_category',
        // 'comments',
    ];

    public function incrementViewCount()
    {
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
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['category'] ?? false, function ($query, $post_category) {
            return $query->whereHas('post_category', function ($query) use ($post_category) {
                $query->where('slug', $post_category);
            });
        });
    }
}
