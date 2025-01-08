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
use App\Models\MedicalRecordFile;
use App\Models\User;
use App\Notifications\AppointmentNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        $medical_record_files= $request->get('medical_record_files',[]);
        DB::beginTransaction();
        try {

            $appointment = Appointment::query()->findOrFail($id);
            $data['appointment_id'] = $appointment->id;
            $item = MedicalRecord::query()->updateOrCreate([
                'id' => @$appointment->medical_record->id,
            ], $data);


            if(isset($medical_record_files)){
                foreach ($medical_record_files as $file){
                    MedicalRecordFile::create([
                        'medical_record_id' => $item->id,
                        'name' => $file,
                    ]);
                }
            }

            $patient = $appointment->patient;
            $doctor = $appointment->doctor;

            Notification::send($patient, new AppointmentNotification([
                'user_id' => $patient->id,
                'title' => 'Appointment diagnosis',
                'body' => 'Doctor ('.$doctor->name.') sent diagnosis for Appointment date ('.$appointment->appointment_date.')',
                'type' => 'appointment_diagnosis',
            ]));

            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function uploadFiles(Request $request){
        return uploadFile($request,'diagnosis-files','file');
    }
    public function removeFile(Request $request){

        $request->validate([
            'file_id' => ['required', 'exists:medical_record_files,id' ,'numeric'],
            'medical_record_id' => ['required', 'exists:medical_records,id' ,'numeric']
        ]);
        $file = MedicalRecordFile::where('medical_record_id',$request->medical_record_id)->where('id',$request->file_id)->first();
        if($file ){
            if($file->name !='default.png'){
                unlink(base_path().'/storage/app/public/diagnosis-files/'. $file->name);
            }
            $file->delete();
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

}

