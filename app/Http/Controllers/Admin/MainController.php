<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest;
use App\Models\Application;
use App\Models\Drones;
use App\Models\DronsModel;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        return view('admin.dashboard',[
            'applications' => Application::orderBy('created_at', 'DESC')->paginate(10),
            'organization' => count(Organization::all()),
            'drones' => count(Drones::all()),
        ]);
    }
}
