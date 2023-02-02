<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\OrganizationField;
use App\Models\OrganizationHistory;
use App\Http\Controllers\Controller;
use App\Models\OrganizationPosition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardOrganizationHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_histories = OrganizationHistory::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.organization-histories.index', compact('organization_histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $organization_positions = OrganizationPosition::all();
        $organization_fields = OrganizationField::all();
        return view('dashboard.organization-histories.create', compact('organizations', 'organization_positions', 'organization_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required',
            'organization_position_id' => 'required',
            'organization_field_id' => 'required',
            'start_year' => 'required',
            'end_year' => 'required'
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
            // ->with('status', 'organization-history-created');
            ->with('success', 'Organization History Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
