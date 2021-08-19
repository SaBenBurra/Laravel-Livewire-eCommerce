<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address_name' => 'required|max:20|min:2',
            'province' => 'required|max:20|min:2',
            'county' => 'required|max:20|min:2',
            'address' => 'required|min:10|max:150',
        ];
    }
}
