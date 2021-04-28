<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PharmaciesRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'name' => 'required|string|max:255',
            'map_location' => 'required',
            'address' => 'required',
            'delivery' => 'required',
            'logo' => 'required',
            'contact_information' => 'required',
            'confirmation' => 'required',
            'image' => 'required',

        ];
    }


}
