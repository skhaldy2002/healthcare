<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
        $id = $this->route('id');
        $password_validation = $this->route('id') ? 'nullable|min:3|confirmed' : 'required|min:3|confirmed';

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:50|unique:users,email,' . $id,
            'phone' => 'required|max:15|unique:users,phone,' . $id,
            'password' => $password_validation,

        ];
    }
    public function messages()
    {
        return [];
    }
}
