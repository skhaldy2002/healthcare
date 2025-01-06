<?php

namespace App\Http\Requests\Appointments;

use App\Rules\IsDoctor;
use App\Rules\IsPatient;
use Illuminate\Foundation\Http\FormRequest;

class DoctorAppointmentDiagnosisRequest extends FormRequest
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

        return [
            'treatment' => ['required'],
            'diagnosis' => 'required',
        ];
    }
    public function messages()
    {
        return [];
    }
}
