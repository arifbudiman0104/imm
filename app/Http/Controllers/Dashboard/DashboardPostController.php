<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardPostController extends Controller
{
    public function index()
    {
        Gate::authorize('verified_account');
        $search = request('search');
        $user = auth()->user();
        if ($search) {
            $allUserPosts = Post::with('post_category')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
                })->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20)
                ->withQueryString();
        } else {
            $allUserPosts = Post::with('post_category')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        return view('dashboard.posts.index', compact('allUserPosts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
