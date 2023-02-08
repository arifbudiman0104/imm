<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationField;
use App\Models\OrganizationHistory;
use App\Http\Controllers\Controller;
use App\Models\OrganizationPosition;

class DashboardOrganizationHistoryController extends Controller
{
    public function index()
    {
        $organization_histories = OrganizationHistory::with('organization', 'organization_position', 'organization_field')
            ->where('user_id', auth()->user()->id)
            ->orderBy('start_year', 'desc')
            ->get();
        return view('dashboard.organization-histories.index', compact('organization_histories'));
    }

    public function create()
    {
        $organizations = Organization::all();
        $organization_positions = OrganizationPosition::all();
        $organization_fields = OrganizationField::all();
        return view('dashboard.organization-histories.create', compact('organizations', 'organization_positions', 'organization_fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required',
            'organization_position_id' => 'required',
            'organization_field_id' => 'required',
            'start_year' => 'digits:4|required',
            'end_year' => 'digits:4|required'
        ]);

        $organization_history = new OrganizationHistory();
        $organization_history->user_id = auth()->user()->id;
        $organization_history->organization_id = $request->organization_id;
        $organization_history->organization_position_id = $request->organization_position_id;
        $organization_history->organization_field_id = $request->organization_field_id;
        $organization_history->start_year = $request->start_year;
        $organization_history->end_year = $request->end_year;
        $organization_history->save();

        return redirect()->route('dashboard.organization-histories.index')
            ->with('success', 'Organization History Created Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(OrganizationHistory $organization_history)
    {
        if ($organization_history->user_id == auth()->user()->id) {
            $organizations = Organization::all();
            $organization_positions = OrganizationPosition::all();
            $organization_fields = OrganizationField::all();
            return view(
                'dashboard.organization-histories.edit',
                compact('organization_history', 'organizations', 'organization_positions', 'organization_fields')
            );
        } else {
            return back()->with('warning', 'You are not authorized to edit this organization history!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'organization_id' => 'required',
            'organization_position_id' => 'required',
            'organization_field_id' => 'required',
            'start_year' => 'digits:4|required',
            'end_year' => 'digits:4|required'
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

    public function destroy($id)
    {
        $organization_history = OrganizationHistory::find($id);
        if ($organization_history->user_id == auth()->user()->id) {
            $organization_history->delete();
            return redirect()->route('dashboard.organization-histories.index')
                ->with('success', 'Organization History Deleted Successfully!');
        } else {
            return redirect()->route('dashboard.organization-histories.index')
                ->with('warning', 'You are not authorized to delete this organization history!');
        }
    }
}
