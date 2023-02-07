<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationHistory;
use Illuminate\Http\Request;

class AdminOrganizationHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization_histories = OrganizationHistory::with('user')
        ->where('user_id', '!=', '1')
        ->orderBy('user_id', 'asc')
        ->paginate(21);
        return view('admin.organization-histories.index', compact('organization_histories'));
        // return $organization_histories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationHistory  $organizationHistory
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationHistory $organizationHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationHistory  $organizationHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationHistory $organizationHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationHistory  $organizationHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationHistory $organizationHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationHistory  $organizationHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationHistory $organizationHistory)
    {
        //
    }
}
