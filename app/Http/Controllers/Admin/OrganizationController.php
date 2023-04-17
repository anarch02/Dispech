<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\Region;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.organizations.index', [
            'organizations' => Organization::orderBy('name')->paginate(10),
            'regions' => Region::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        Organization::create($request->validated());

        // return redirect(route('admin.models.show',  $model->id));

        return response()->json(['success'=>'Success!']);
    }

            /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.organizations.edit', [
            'organization' => Organization::findOrFail($id),
            'regions' => Region::get()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, $id)
    {
        // dd($request);
        $organization = Organization::findOrFail($id);
        $organization->update($request->validated());

        // return response()->json(['success'=>'Success!']);
        return redirect(route('organizations.index'))->with('message', 'Изменения были сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organization::destroy($id);

        return redirect(route('organizations.index'))->with('message', 'Организация был удален');
    }
}
