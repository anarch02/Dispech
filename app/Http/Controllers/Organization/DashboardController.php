<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $organization = Auth::user()->organization;
        // $pilots = count($organization->users);
        // // dd($pilots);

        // $drones = count($organization->drones);

        return redirect(route('organization.application.list'));

        // return view('home', [
        //     'organization' => $organization,
        //     'pilots' => $pilots,
        //     'drones' => $drones,
        // ]);
    }
}
