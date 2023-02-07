<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('post_category', 'user')
            ->latest()
            ->filter(request(['search', 'category']))
            ->where('is_published', true)
            ->where('is_approved', true)
            ->where('is_rejected', false)
            ->orderBy('published_at', 'desc')
            ->simplePaginate(10)
            ->withQueryString();
        $countPosts = Post::with('post_category', 'user')
            ->latest()
            ->where('is_published', true)
            ->where('is_approved', true)
            ->where('is_rejected', false)
            ->orderBy('published_at', 'desc')
            ->count();
        $postsCategories = PostCategory::with('posts')
            ->where('id', '!=', 1)
            ->orderBy('title', 'asc')
            ->get();
        $categoryTitle = '';
        if (request('category')) {
            $category = PostCategory::firstWhere('slug', request('category'));
            $categoryTitle = $category->title;
        }
        return view('posts', compact('posts', 'postsCategories', 'countPosts', 'categoryTitle'));
    }
    public function post($slug)
    {
        $post = Post::with('post_category', 'user', 'comments')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->firstOrFail();
        $relatedPosts = Post::with('post_category', 'user')
            ->where('slug', '!=', $post->slug)
            ->where('post_category_id', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approved', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();
        $recommendedPosts = Post::with('post_category', 'user')
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
        return view('post', compact('post', 'relatedPosts', 'recommendedPosts'));
    }
}
