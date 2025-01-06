<?php

namespace App\Http\Controllers\Patient\Dashboard;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Appointments\AppointmentRequest;
use App\Http\Resources\Appointments\PatientAppointmentResource;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientAppointmentController111 extends Controller
{



    public function store(AppointmentRequest $request, $id = null)
    {
        $data = $request->only(Appointment::FILLABLE);
        DB::beginTransaction();
        try {
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



}

