<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
            return view('user', compact('user', 'posts'));
        } else {
            return redirect()->route('home');
        }
        // dd($user, $posts);
    }
}
