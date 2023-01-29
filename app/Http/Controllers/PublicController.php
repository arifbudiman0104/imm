<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
        $related_posts = Post::with('post_category', 'user')
            ->where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->where('is_published', true)
            ->where('is_approve', true)
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        $recommended_posts = Post::with('post_category', 'user')
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->where('is_approve', true)
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

    public function commentStore(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'text' => 'required|string|max:255',
            ]);
            Comment::create([
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
                'text' => $request->text,
            ]);
            // dd($request->all());
            return back()->with('status', 'comment-created');
        }
        return redirect()->route('login');
    }
}
