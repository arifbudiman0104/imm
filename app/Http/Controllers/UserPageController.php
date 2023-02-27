<?php

namespace App\Http\Controllers;

use App\Models\OrganizationHistory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function user($username)
    {
        $user = User::with('organization')
            ->where('username', $username)
            ->firstOrFail();
        if ($user->is_verified == true) {
            $organizationHistories = OrganizationHistory::with('organization', 'organization_position', 'organization_field')
                ->where('user_id', $user->id)
                ->where('is_approved', true)
                ->orderBy('is_active', 'desc')
                ->orderBy('start_year', 'desc')
                ->get();
            $posts = Post::with('post_category')
                ->where('user_id', $user->id)
                ->where('is_published', true)
                ->where('is_approved', true)
                ->orderBy('published_at', 'desc')
                ->paginate(12);
            return view('userpage', compact('user', 'posts', 'organizationHistories'));
        } else {
            return redirect()->route('home');
        }
    }
}
