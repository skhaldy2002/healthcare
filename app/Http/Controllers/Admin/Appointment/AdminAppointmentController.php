<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Appointments\AdminAppointmentRequest;
use App\Http\Requests\Appointments\AppointmentRequest;
use App\Http\Requests\Appointments\DoctorAppointmentRequest;
use App\Http\Resources\Appointments\AdminAppointmentResource;
use App\Http\Resources\Appointments\DoctorAppointmentResource;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAppointmentController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $length = \request()->get('length', 10);
            $items = Appointment::query()->with(['patient','doctor'])->orderByDesc('id')->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber($length));
            return datatable_response($items, null, AdminAppointmentResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'Home','active' => true],
            ['page' => '#' , 'title' =>'Appointments','active' => false],
        ];
        return view('dashboard.admin.appointments.index', [
            'page_title' =>'home',
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);


    }

    public function create($id = null)
    {
        $page_title = __('create');
        $patients = User::query()->patients()->get();
        $doctors = User::query()->doctors()->get();
        if (isset($id)) {
            $page_title = __('edit');
            try {
                $item = Appointment::query()->filter()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'home','active' => true],
            ['page' => route('admin.appointments.index') , 'title' =>'appointments','active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('edit'):__('add'),'active' => false],
        ];
        return view('dashboard.admin.appointments.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
            'patients' => $patients,
            'doctors' => $doctors,
        ]);
    }
    public function store(AdminAppointmentRequest $request, $id = null)
    {
        $data = $request->only(Appointment::FILLABLE);
        DB::beginTransaction();
        try {

            // التحقق من إذا كان الموعد محجوزًا بالفعل
            $isBooked = Appointment::query()
                ->where('appointment_date', $data['appointment_date']) // تحقق من التاريخ والوقت
                ->where('patient_id', $data['patient_id']) // تحقق من المريض
                ->where('doctor_id', $data['doctor_id']) // تحقق من الطبيب
                ->filter()
                ->exists();

            if ($isBooked) {
                return back()->withErrors(['message' => 'This appointment is already booked.']);
            }

            $item = Appointment::query()->filter()->updateOrCreate([
                'id' => $id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
    public function cancel($id){
        try {
            $item = Appointment::query()->filter()->findOrFail($id);
            $item->update([
                'status' =>Enum::CANCELLED
            ]);
            return $this->response_json(true, StatusCodes::OK, 'Cancel Successfully');
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }


    }
    public function confirm($id){
        try {
            $item = Appointment::query()->filter()->findOrFail($id);
            $item->update([
                'status' =>Enum::CONFIRMED
            ]);
            return $this->response_json(true, StatusCodes::OK, 'confirm Successfully');
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }


    }

}

