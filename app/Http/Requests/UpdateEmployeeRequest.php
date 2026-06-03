<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname'  => 'required|string|max:255',
            'lastname'   => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:50',
        ];
    }


}
