<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\AppointmentRequest;
use App\Http\Requests\Patients\PatientRequest;
use App\Models\User;
use App\Notifications\VerifyByAdminNotification;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Resources\UserManagement\Patients\AdminPatientResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class AdminPatientController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $length = \request()->get('length', 10);
            $items = User::query()->orderByDesc('id')->patients()->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber($length));
            return datatable_response($items, null, AdminPatientResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'Home','active' => true],
            ['page' => '#' , 'title' =>'Patients','active' => false],
        ];
        return view('dashboard.admin.patients.index', [
            'page_title' =>'home',
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);


    }

    public function create($id = null)
    {
        $page_title = __('create');
        if (isset($id)) {
            $page_title = __('edit');
            try {
                $item = User::query()->with('patientAppointments')->patients()->filter()->findOrFail($id);
                $appointments = $item->patientAppointments;
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'home','active' => true],
            ['page' => route('admin.patients.index') , 'title' =>'patients','active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('edit'):__('add'),'active' => false],
        ];
        return view('dashboard.admin.patients.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
            'appointments' => @$appointments,
        ]);
    }
    public function store(PatientRequest $request, $id = null)
    {
        $data = $request->only(User::FILLABLE);
        if(isset($data['photo'])){
            $data['photo'] =  uploadFile($request,'user-photos','photo');
        }else{
            unset($data['photo']);
        }
        $data['role'] = Enum::PATIENT;
        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
    public function delete($id){
        try {
            $item = User::query()->patients()->findOrFail($id);
            $item->update([
                'is_deleted' =>!$item->is_deleted
            ]);
            return $this->response_json(true, StatusCodes::OK, 'Delete Successfully');
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }


    }
    public function verifyByAdmin($id){
        try {
            $patient = User::query()->patients()->findOrFail($id);
            $patient->update([
                'verified_by_admin' =>!$patient->verified_by_admin
            ]);

            $body = '';
            $body = $patient->verified_by_admin?$body.'Not verified':$body.'Verified';
            Notification::send($patient, new VerifyByAdminNotification([
                'user_id' => $patient->id,
                'title' => $body.' by admin',
                'body' => $body.' by admin your account ('.$patient->name.')',
                'type' => 'verify_by_admin',
            ]));

            return $this->response_json(true, StatusCodes::OK, 'Verify Successfully');
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }


    }

}
