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
        $user = User::where('username', $username)->firstOrFail();

        if ($user->is_verified == true) {
            $organizationHistoriesActive = OrganizationHistory::with('organization', 'organization_position')
                ->where('user_id', $user->id)
                ->where('is_approved', true)
                ->where('is_active', true)
                ->orderBy('start_year', 'desc')
                ->get();

            $organizationHistoriesNotActive = OrganizationHistory::with('organization', 'organization_position')
                ->where('user_id', $user->id)
                ->where('is_approved', true)
                ->where('is_active', false)
                ->orderBy('start_year', 'desc')
                ->get();

            $posts = Post::with('post_category')
                ->where('user_id', $user->id)
                ->where('is_published', true)
                ->where('is_approved', true)
                ->orderBy('published_at', 'desc')
                ->paginate(12);

            return view('userpage', compact('user', 'posts', 'organizationHistoriesActive', 'organizationHistoriesNotActive'));
        } else {
            return redirect()->route('home');
        }
    }
}
