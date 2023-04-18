<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::orderBy('organization_id')->paginate(10),
            'organizations' => Organization::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'organization_id' => ['required'],
            'login' => ['required', 'unique:users', 'unique:admin_users'],
            'password' => ['required', 'confirmed']
        ]);

        $data['password'] = Hash::make($data['password']);

        // dd($data);

        User::create($data);

        return response()->json(['success' => 'Success!']);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', [
            'user' => User::findOrFail($id),
            'organizations' => Organization::get()
        ]);
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
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'organization_id' => ['required'],
            'login' => ['required'],
            'password' => ['nullable', 'confirmed']
        ]);
        

        if($data['password'])
        {
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user['password'];
        }

        $user->update($data);
        // return response()->json(['success' => 'Success!']);
        return redirect(route('users.index'))->with('message', 'Изменения были успешно сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->validate([
            'id' => ['required']
        ]);

        User::destroy($id);

        return redirect(route('users.index'))->with('message', 'Пользователь был удален');
    }
}
