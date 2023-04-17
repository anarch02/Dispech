<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Drones;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class WordController extends Controller
{
    public function user_info(Request $request)
    {
        // dd($request);
        // $drones = Drones::get();

        $id = $request->id;
        $user = User::findOrFail($id);
        $templateProcessor = new TemplateProcessor('report/word/user.docx');
        $templateProcessor->setValue('id', $user->id);
        $templateProcessor->setValue('name', $user->name);
        $templateProcessor->setValue('email', $user->email);
        $templateProcessor->setValue('address', $user->organization->name);
        $fileName = $user->name;
        

        // $str = 'num';
        // $templateProcessor->cloneRow('num', count($drones));
        // $i=0;
        // foreach ($drones as $drone){
        //     $templateProcessor->setValue('num#'.$i, $i+1);
        //     $templateProcessor->setValue('model#'.$i, $drone->model->title);
        //     $templateProcessor->setValue('id_number#'.$i, $drone['id_number']);
        //     $i++;
        // }

        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function organization_list()
    {
        //
    }

    public function model_list()
    {
        //
    }

    public function organization()
    {
        //
    }

    public function application_list()
    {
        //
    }

    public function application(Request $request)
    {
        $id = $request->id;
        $application = Application::findOrFail($id);
        $templateProcessor = new TemplateProcessor('report/word/application.docx');
        $templateProcessor->setValue('id', $application->id);
        $templateProcessor->setValue('height', $application->height);
        $templateProcessor->setValue('cause', $application->cause);
        $templateProcessor->setValue('organization', $application->organization->name);
        $fileName = $application->id;
        

        $templateProcessor->saveAs($fileName . '.docx');

        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
