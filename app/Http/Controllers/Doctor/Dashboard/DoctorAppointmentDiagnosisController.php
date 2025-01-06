<?php

namespace App\Http\Controllers\Doctor\Dashboard;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Appointments\AppointmentRequest;
use App\Http\Requests\Appointments\DoctorAppointmentDiagnosisRequest;
use App\Http\Requests\Appointments\DoctorAppointmentRequest;
use App\Http\Resources\Appointments\DoctorAppointmentResource;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentDiagnosisController extends Controller
{


    public function create($id = null)
    {
        $page_title = __('create');
        try {
            $appointment = Appointment::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $page_breadcrumbs = [
            ['page' => route('doctor.dashboard.index') , 'title' =>'home','active' => true],
            ['page' => route('doctor.appointments.index') , 'title' =>'appointments','active' => true],
            ['page' => '#' , 'title' =>__('add'),'active' => false],
        ];
        return view('dashboard.doctor.diagnosis.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'appointment' => @$appointment,
        ]);
    }
    public function store(DoctorAppointmentDiagnosisRequest $request, $id = null)
    {
        $data = $request->only(MedicalRecord::FILLABLE);
        DB::beginTransaction();
        try {

            $appointment = Appointment::query()->findOrFail($id);
            $data['appointment_id'] = $appointment->id;
            $item = MedicalRecord::query()->updateOrCreate([
                'id' => @$appointment->medical_records->id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return $this->returnBackWithSaveDoneFailed();
        }
    }

}

