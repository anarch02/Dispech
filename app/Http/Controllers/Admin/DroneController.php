<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DroneRequest;
use App\Models\Drones;
use App\Models\DronsModel;
use App\Models\Organization;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.drones.index', [
            'drones' => Drones::orderBy('created_at', 'DESC')->paginate(10),
            'organizations' => Organization::get(),
            'models' => DronsModel::get()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DroneRequest $request)
    {
        $drone = Drones::create($request->validated());

        return response()->json(['success'=>'Success!']);
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
        return view('admin.drones.edit', [
            'drone' => Drones::findOrFail($id),
            'organizations' => Organization::get(),
            'models' => DronsModel::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DroneRequest $request, $id)
    {
        $drone = Drones::findOrFail($id);
        $drone->update($request->validated());

        return redirect(route('drones.index'))->with('message', 'Изменения были сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Drones::destroy($request->id);

        return redirect(route('drones.index'))->with('message', 'Устройства был удален');
    }
}
