<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search) {
            $posts = Post::with('post_category', 'user')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
                })
                ->where('is_published', true)
                ->where('is_approved', true)
                ->where('is_rejected', false)
                ->orderBy('published_at', 'desc')
                ->paginate(12)
                ->withQueryString();
        } else {
            $posts = Post::with('post_category', 'user')
                ->where('is_published', true)
                ->where('is_approved', true)
                ->where('is_rejected', false)
                ->orderBy('published_at', 'desc')
                ->paginate(12);
        }
        return view('posts', compact('posts'));
    }
    public function post($slug)
    {
        $post = Post::with('post_category', 'user', 'comments')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->firstOrFail();
        $related_posts = Post::with('post_category', 'user')
            ->where('slug', '!=', $post->slug)
            ->where('post_category_id', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();
        $recommended_posts = Post::with('post_category', 'user')
            ->where('slug', '!=', $post->slug)
            ->where('post_category_id', '!=', $post->post_category_id)
            ->inRandomOrder()
            ->where('is_published', true)
            ->where('is_approved', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        if (!Cookie::has('post_' . $post->slug)) {
            $post->incrementViewCount();
            Cookie::queue('post_' . $post->slug, 'true', 60 * 2);
        }

        return view('post', compact('post', 'related_posts', 'recommended_posts'));
    }
}
