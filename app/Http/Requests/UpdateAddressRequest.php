<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'address_name' => 'required|max:20|min:2',
            'province' => 'required|max:20|min:2',
            'county' => 'required|max:20|min:2',
            'address' => 'required|min:10|max:150',
        ];
    }
}
