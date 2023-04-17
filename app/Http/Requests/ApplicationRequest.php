<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'organization_id' => ['required'],
            'height'=> ['required', 'integer'],            
            'radius' => ['required'],
            'place' => ['required'],
            'cause'=> ['required'], //причина 
            'drones' => ['required'],
            'pilots' => ['required'],
            'startDate' => ['required'],
            'finishDate' => ['required'],
            // 'centerLat' => ['required'],
            // 'centerLng' => ['required'],
            // 'zoom' => ['required'],
            // 'lat' => ['required'],
            // 'lng' => ['required'],
        ];
    }
}
