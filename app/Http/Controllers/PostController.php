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
            $posts = Post::where(function ($query) use ($search) {
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
            $posts = Post::where('is_published', true)
                ->where('is_approved', true)
                ->where('is_rejected', false)
                ->orderBy('published_at', 'desc')
                ->paginate(12);
        }
        return view('posts', compact('posts'));
    }
    public function post($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->firstOrFail();
        // dd($post);
        $related_posts = Post::with('post_category', 'user')
            ->where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        $recommended_posts = Post::with('post_category', 'user')
            ->where('id', '!=', $post->id)
            ->where('post_category_id', '!=', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        if (!Cookie::has('post_' . $post->slug)) {
            $post->incrementViewCount();
            Cookie::queue('post_' . $post->slug, 'true', 60 * 2);
        }

        $comments = $post
            ->comments()
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($comments)->toArray();
        return view('post', compact('post', 'related_posts', 'recommended_posts', 'comments'));
    }
}
