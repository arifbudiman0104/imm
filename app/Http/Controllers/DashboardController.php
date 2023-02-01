<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $allPosts = Auth::user()->posts->count();
        $draftPosts = Auth::user()->posts->where('is_published', 0)->count();
        $publishedPosts = Auth::user()->posts->where('is_published', 1)->count();
        $approvedPosts = Auth::user()->posts->where('is_approved', 1)->count();
        $publishedApprovedPosts = Auth::user()->posts->where('is_published', 1)->where('is_approved', 1)->count();
        $rejectedPosts = Auth::user()->posts->where('is_rejected', 1)->count();
        $requestedPosts = Auth::user()->posts->where('is_requested', 1)->count();
        $totalViews = Auth::user()->posts->sum('views');
        $user = Auth::user();
        $postIds = $user->posts->pluck('id');
        $totalComments = Comment::whereIn('post_id', $postIds)->count();

        return view('dashboard.index', compact(
            'allPosts',
            'draftPosts',
            'publishedPosts',
            'publishedApprovedPosts',
            'approvedPosts',
            'rejectedPosts',
            'requestedPosts',
            'totalViews',
            'totalComments'
        ));
    }
}
