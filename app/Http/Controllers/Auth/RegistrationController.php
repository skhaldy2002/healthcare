<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Enum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PatientRegisterRequest;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function patientOrDoctorSignup(){
        return view('dashboard.auth.patient_or_doctor');
    }
    public function patientSignupView(){
        return view('dashboard.auth.patient_signup');
    }

    public function doctorSignupView(){
        $specialties = Specialty::all();
        return view('dashboard.auth.doctor_signup',[
            'specialties'=>$specialties
        ]);
    }
    public function patientSignup(PatientRegisterRequest $request)
    {
        $data = $request->only(User::FILLABLE);
        $data['role'] = Enum::PATIENT;
        $plainPassword = rand(100000, 999999);
        $data['password'] = Hash::make($plainPassword);

        DB::beginTransaction();
        try {
            $item = User::query()->create($data);
            DB::commit();

             return back()->with([
                'message' => 'Register Done,please use this password ('.$plainPassword.') for login',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
    public function doctorSignup(DoctorRegisterRequest $request)
    {
        $data = $request->only(User::FILLABLE);
        $data['role'] = Enum::DOCTOR;
        $plainPassword = rand(100000, 999999);
        $data['password'] = Hash::make($plainPassword);

        DB::beginTransaction();
        try {
            $item = User::query()->create($data);
            DB::commit();

             return back()->with([
                'message' => 'Register Done,please use this password ('.$plainPassword.') for login',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
    public function logout(){
        Session::flush();
        auth('web')->logout();

        return redirect()->route('login')->with([
            'success' => 'Signed out Successfully'
        ]);

    }
}
