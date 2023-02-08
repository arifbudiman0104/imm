<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationHistory;
use App\Http\Controllers\Controller;
use App\Models\OrganizationPosition;
use Illuminate\Support\Facades\Gate;
use App\Models\OrganizationField;

class AdminOrganizationHistoryController extends Controller
{
    public function index()
    {
        Gate::authorize('admin') || Gate::authorize('superadmin');
        $organization_histories = OrganizationHistory::with('user')
            ->where('user_id', '!=', '1')
            ->orderBy('user_id', 'asc')
            ->paginate(21);
        return view('admin.organization-histories.index', compact('organization_histories'));
        // return $organization_histories;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(OrganizationHistory $organizationHistory)
    {
        //
    }

    public function edit(OrganizationHistory $organization_history)
    {
        $organizations = Organization::all();
        $organization_positions = OrganizationPosition::all();
        $organization_fields = OrganizationField::all();
        return view(
            'admin.organization-histories.edit',
            compact(
                'organization_history',
                'organizations',
                'organization_positions',
                'organization_fields'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'organization_id' => 'required',
            'organization_position_id' => 'required',
            'organization_field_id' => 'required',
            'start_year' => 'required',
            'end_year' => 'required'
        ]);

        $organization_history = OrganizationHistory::find($id);
        $organization_history->organization_id = $request->organization_id;
        $organization_history->organization_position_id = $request->organization_position_id;
        $organization_history->organization_field_id = $request->organization_field_id;
        $organization_history->start_year = $request->start_year;
        $organization_history->end_year = $request->end_year;
        $organization_history->save();

        return redirect()->route('dashboard.organization-histories.index')
            ->with('success', 'Organization History Updated Successfully!');
    }

    public function destroy(OrganizationHistory $organizationHistory)
    {
        Gate::authorize('admin') || Gate::authorize('superadmin');
        $organizationHistory->delete();
        return back()->with('success', 'Organization History Deleted Successfully');
    }
}