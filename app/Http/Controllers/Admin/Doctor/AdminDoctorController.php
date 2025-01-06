<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctors\AdminDoctorRequest;
use App\Http\Resources\UserManagement\Doctors\AdminDoctorResource;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminDoctorController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $length = \request()->get('length', 10);
            $items = User::query()->orderByDesc('id')->doctors()->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber($length));
            return datatable_response($items, null, AdminDoctorResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'Home','active' => true],
            ['page' => '#' , 'title' =>'Doctors','active' => false],
        ];
        return view('dashboard.admin.doctors.index', [
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
                $item = User::query()->with('doctorAppointments')->doctors()->filter()->findOrFail($id);
                $appointments = $item->doctorAppointments;
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('admin.dashboard.index') , 'title' =>'home','active' => true],
            ['page' => route('admin.doctors.index') , 'title' =>'doctors','active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('edit'):__('add'),'active' => false],
        ];
        return view('dashboard.admin.doctors.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
            'appointments' => @$appointments,
            'specialties' => Specialty::query()->get(),
        ]);
    }
    public function store(AdminDoctorRequest $request, $id = null)
    {
        $data = $request->only(User::FILLABLE);
        if(isset($data['photo'])){
            $data['photo'] =  uploadFile($request,'user-photos','photo');
        }else{
            unset($data['photo']);
        }
        $data['role'] = Enum::DOCTOR;
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
            $item = User::query()->doctors()->findOrFail($id);
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
            $item = User::query()->doctors()->findOrFail($id);
            $item->update([
                'verified_by_admin' =>!$item->verified_by_admin
            ]);
            return $this->response_json(true, StatusCodes::OK, 'Verify Successfully');
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }


    }

}
