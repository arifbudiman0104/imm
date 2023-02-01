<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PublicController extends Controller
{
    public function home()
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
    public function posts()
    {
        $posts = Post::where('is_published', true)
            ->where('is_approved', true)
            ->where('is_rejected', false)
            ->orderBy('published_at', 'desc')
            ->paginate(12);
        // dd($posts->toArray());
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

    public function commentDestroy(Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id || Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('status', 'comment-deleted');
        }
        return back()->with('status', 'comment-delete-failed');
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->text = $request->text;
            $comment->save();
            return back()->with('status', 'comment-updated');
        } else if (Auth::user()->is_admin) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->timestamps = false;
            $comment->text = $request->text;
            $comment->save();
            return back()->with('status', 'comment-updated-as-admin');
        }
        return back()->with('status', 'comment-update-failed');
    }

    public function commentReport(Comment $comment)
    {
        if (Auth::check()) {
            $comment->timestamps = false;
            $comment->incrementSpamCount();
            $comment->is_spam = true;
            $comment->save();
            return back()->with('status', 'comment-reported');
        }
        return redirect()->route('login');
        // return back()->with('status', 'comment-report-failed');
    }

    public function commentMarkNotSpam(Comment $comment)
    {
        if (Auth::user()->is_admin) {
            $comment->timestamps = false;
            $comment->spam_count = 0;
            $comment->is_spam = false;
            $comment->save();
            return back()->with('status', 'comment-marked-not-spam');
        }
        return back()->with('status', 'comment-mark-not-spam-failed');
    }

    public function user($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if ($user->is_verified == true) {
            $user = User::where('username', $username)->firstOrFail();
            $posts = $user
                ->posts()
                ->where('is_published', true)
                ->where('is_approved', true)
                ->orderBy('published_at', 'desc')
                ->paginate(12);
            return view('user', compact('user', 'posts'));
        } else {
            return redirect()->route('home');
        }
        // dd($user, $posts);
    }
}
