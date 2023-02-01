<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured_posts = Post::where('is_published', true)
            ->where('is_approved', true)
            ->where('is_featured', true)
            ->where('is_rejected', false)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();
        // dd($featured_posts);
        return view('home', compact('featured_posts'));
    }
}
