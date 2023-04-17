<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Coordinate;
use App\Models\Drones;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){
        $id = Auth::user()->organization_id;        
        $application = Application::where('organization_id', '=', $id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('applications.index', [
            'applications' => $application
        ]);
    }

    public function admin_index(){
        return view('applications.admin', [
            'applications' => Application::orderBy('created_at', 'DESC')->paginate(10)
        ]);
    }


    public function create(Request $request)
    {
        $id = Auth::user()->organization_id;
        $organization = Organization::findOrFail($id);
        $pilots = $organization->pilots;
        $drones = $organization->drones;

        return view('applications.create', [
            'drones' => $drones,
            'pilots' => $pilots
        ]);
    }

    public function store(ApplicationRequest $request)
    {
        $data = $request->validated();

        $array1 = $request->lat;
        $array2 = $request->lng;

        array_shift($array1);
        array_shift($array2);

        $application = Application::create($data);

        for ($i=0; $i<count($array1); $i++)
        {
            $point = [
                'application_id' => $application->id,
                'lat' => $array1[$i],
                'lng' => $array2[$i],
                'zoom' => $request->zoom,
                'centerLat' => $request->centerLat,
                'centerLng' => $request->centerLng,
            ];

            Coordinate::create($point);
        }


        $application->drones()->attach($request->get('drones'));
        $application->users()->attach($request->get('pilots'));

        return redirect(route('organization.application.list'))->with('message', 'Заявление был успешно отправлен');
    }

    public function show($id)
    {
        return view('applications.show', [
            'application' => Application::findOrFail($id)
        ]);
    }

    public function admin_show($id)
    {
        return view('applications.admin_show', [
            'application' => Application::findOrFail($id)
        ]);
    }

    public function application_status(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        if($request->allow)
        {
            // $status  = $request->allow;
            $application->status  = true;
        }
        elseif($request->comment)
        {
            // dd($request->comment);
            // $comment = $request->validate([
            //     'comment' => ['required', 'string', 'min:5']
            // ]);
            $comment  = $request->comment;
            $application->comment  = $comment;
            // dd($comment);
        }

        $application->save();            


        // dd($application);


        return redirect(route('admin.application.list'));
    }
}
