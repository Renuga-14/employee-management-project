<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'contact_number' => ['required', 'unique:employees,contact_number', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
            'email' => 'required|email|unique:employees,email|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
