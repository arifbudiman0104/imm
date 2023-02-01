<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
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
            $organizationHistoriesActive = $user->organizationHistory()
                ->where('is_approved', true)
                ->where('is_active', true)
                ->orderBy('start_year', 'desc')
                ->get();
            $organizationHistoriesNotActive = $user->organizationHistory()
                ->where('is_approved', true)
                ->where('is_active', false)
                ->orderBy('start_year', 'desc')
                ->get();
            // dd($organizationHistories);
            return view('userpage', compact('user', 'posts', 'organizationHistoriesActive', 'organizationHistoriesNotActive'));
        } else {
            return redirect()->route('home');
        }
        // dd($user, $posts);
    }
}
