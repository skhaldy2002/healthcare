<?php

namespace App\Http\Requests\Appointments;

use App\Rules\IsDoctor;
use App\Rules\IsPatient;
use Illuminate\Foundation\Http\FormRequest;

class DoctorAppointmentRequest extends FormRequest
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
            'patient_id' => ['required','numeric' , 'exists:users,id', new IsPatient()],
            'appointment_date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [];
    }
}
