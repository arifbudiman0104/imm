<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends Controller
{
    public function index()
    {
        Gate::authorize('admin')||Gate::authorize('superadmin');
        $users = User::orderBy('name')
            ->where('id', '!=', '1')
            ->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('admin')||Gate::authorize('superadmin');
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('admin')||Gate::authorize('superadmin');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        dd($user);

        return redirect()->route('admin.users.index')->with('status', 'user-created');
    }

    public function show(User $user)
    {
        //
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
        Gate::authorize('admin')||Gate::authorize('superadmin');
        $user->delete();
        return back();
    }

    public function makeSuperAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 1;
        $user->is_admin = 1;
        $user->save();
        return back();
    }

    public function removeSuperAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 0;
        $user->is_admin = 1;
        $user->save();
        return back();
    }

    public function makeAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_admin = 1;
        $user->save();
        return back();
    }

    public function removeAdmin(User $user)
    {
        Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_superadmin = 0;
        $user->is_admin = 0;
        $user->save();
        return back();
    }

    public function verify(User $user)
    {
        Gate::authorize('admin')||Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_verified = 1;
        $user->save();
        return back();
    }

    public function unverify(User $user)
    {
        Gate::authorize('admin')||Gate::authorize('superadmin');
        $user->timestamps = false;
        $user->is_verified = 0;
        $user->save();
        return back();
    }
}
