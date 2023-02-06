<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends Controller
{
    public function index()
    {
        Gate::authorize('admin', 'superadmin');
        $search = request('search');
        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->orderBy('name')
                ->where('id', '!=', '1')
                ->paginate(20)
                ->withQueryString();
        } else {
            $users = User::orderBy('name')
                ->where('id', '!=', '1')
                ->paginate(20);
        }
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Gate::authorize('admin')||Gate::authorize('superadmin');
        // $organizations = Organization::all();
        // return view('admin.users.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('admin')||Gate::authorize('superadmin');
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();
        // dd($user);

        // return redirect()->route('admin.users.index')->with('status', 'user-created');
    }

    public function show(User $user)
    {
        Gate::authorize('admin', 'superadmin');
        // $organization_history = $user->organization_history;
        return view('admin.users.show', compact('user'));
        // return $user;
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin', 'superadmin');
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    public function makeSuperAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 1;
        $user->is_admin = 1;
        $user->save();
        return back()->with('success', 'User made superadmin successfully!');
    }

    public function removeSuperAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 0;
        $user->is_admin = 1;
        $user->save();
        return back()->with('success', 'User removed from superadmin successfully!');
    }

    public function makeAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_admin = 1;
        $user->save();
        return back()->with('success', 'User made admin successfully!');
    }

    public function removeAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 0;
        $user->is_admin = 0;
        $user->save();
        return back()->with('success', 'User removed from admin successfully!');
    }

    public function verify(User $user)
    {
        Gate::authorize('admin');
        if (Auth::user()->is_admin == true && Auth::user()->is_superadmin == false) {
            if ($user->pob != null && $user->dob != null && $user->gender != null && $user->phone != null && $user->address != null && $user->username != null) {
                $user->timestamps = false;
                $user->is_verified = 1;
                $user->save();
                return back()->with('success', 'User verified successfully!');
            } else {
                return back()->with('warning', 'Only completed user can be verified!');
            }
        } else {
            $user->timestamps = false;
            $user->is_verified = 1;
            $user->save();
            return back()->with('success', 'User verified successfully!');
        }
    }

    public function unverify(User $user)
    {
        Gate::authorize('admin');
        $user->timestamps = false;
        $user->is_verified = 0;
        $user->save();
        return back()->with('success', 'User unverified successfully!');
    }

    public function resetPassword(User $user){
        Gate::authorize('admin');
        $user->timestamps = false;
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();
        return back()->with('success', 'User password reset successfully!');
    }
}
