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
            ->orderBy('published_at', 'desc')
            ->paginate(12);
        // dd($posts->toArray());
        return view('posts', compact('posts'));
    }
}
