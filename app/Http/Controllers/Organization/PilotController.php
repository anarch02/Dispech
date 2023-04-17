<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PilotController extends Controller
{
    public function index()
    {
        $id = Auth::user()->organization_id;
        $organization = Organization::findOrFail($id);
        $users = $organization->pilots;
         // dd($organization);
        return view('organizations.users.index', [
            'users' => $users
        ]);
    }
}
