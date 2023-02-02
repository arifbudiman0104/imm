<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminSystemController extends Controller
{
    public function index()
    {
        Gate::authorize('admin') || Gate::authorize('superadmin');
        $systems = System::all();
        return view('admin.systems.index', compact('systems'));
    }

    public function enable(System $system)
    {
        Gate::authorize('admin');
        $system->is_active = true;
        $system->save();
        return redirect()->route('admin.systems.index')->with('success', 'Registered system enabled successfully!');
    }

    public function disable(System $system)
    {
        Gate::authorize('admin');
        $system->is_active = false;
        $system->save();
        return redirect()->route('admin.systems.index')->with('success', 'Registered system disabled successfully!');
    }
}
