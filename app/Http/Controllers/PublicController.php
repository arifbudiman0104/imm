<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $featured_posts = Post::where('is_published', true)
            ->where('is_approve', true)
            ->where('is_featured', true)
            ->where('is_reject', false)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();
        // dd($featured_posts);
        return view('home', compact('featured_posts'));
    }
    public function posts()
    {
        $posts = Post::where('is_published', true)
            ->where('is_approve', true)
            ->where('is_reject', false)
            ->orderBy('published_at', 'desc')
            ->paginate(12);
        // dd($posts->toArray());
        return view('posts', compact('posts'));
    }
    public function post($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->where('is_approve', true)
            ->firstOrFail();
        // dd($post);
        $related_posts = Post::where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approve', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();
        // dd($related_posts)->toArray();
        $recommended_posts = Post::where('id', '!=', $post->id)
            ->where('is_published', true)
            ->where('is_approve', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();
        return view('post', compact('post', 'related_posts', 'recommended_posts'));
    }
}
