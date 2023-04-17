<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest;
use App\Models\Drones;
use App\Models\DronsModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ModelController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = DronsModel::orderBy('title')->paginate(25);

        $drones = Drones::orderBy('title')->paginate(25);

        return view('admin.models.index', [
            'models' => $models,
            'drones' => $drones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelRequest $request)
    {
        // $this->authorize('can-super-admin');

        $model = DronsModel::create($request->validated());

        // return redirect(route('admin.models.show',  $model->id));

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
        $model = DronsModel::findOrFail($id);
        // $drones = $model->drones;

        return view('admin.models.show', [
            'model'=> $model
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ModelRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelRequest $request, $id)
    {
        // return response()->json($request);
        $model = DronsModel::findOrFail($request->id);
        $model->update($request->validated());

        // return response()->json(['success'=>'Success!']);
        return redirect(route('models.index'))->with('message', 'Изменения были сохранены');
        // return RedirectResponse(route())
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DronsModel::destroy($id);

        // return response()->json(['success'=>'Success!']);
        return redirect(route('models.index'))->with('message', 'Модель был удален');
    }
}
