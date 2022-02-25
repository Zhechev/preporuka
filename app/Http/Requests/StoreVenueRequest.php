<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVenueRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'title' => 'required|min:3',
            'city_id' => 'required|integer',
            'address' => 'required',
            'phone' => 'nullable|digits:10',
            'email' => 'nullable|email',
            'website' => 'nullable|min:3',
            'facebook' => 'nullable|min:3',
            'instagram' => 'nullable|min:3',
            'content_bg' => 'nullable|min:10',
            'content_en' => 'nullable|min:10',
            'features_bool' => 'required|min:3',
            'lat' => 'nullable',
            'lng' => 'nullable',
        ];
    }
}
