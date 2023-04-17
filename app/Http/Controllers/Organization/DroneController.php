<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DroneController extends Controller
{
    public function index()
    {
        $id = Auth::user()->organization_id;
        $organization = Organization::findOrFail($id);
        $drones = $organization->drones;

        return view('organizations.drones.index', [
            'drones' => $drones
        ]);

    }
}
