<?php

namespace App\Http\Resources\Appointments;

use App\Constants\Enum;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => view('dashboard.admin.appointments.partial.datatable_cols._id',[
                'item' => $this
            ])->render(),
            'doctor' => view('dashboard.admin.appointments.partial.datatable_cols._doctor',[
                'item' => $this
            ])->render(),
            'patient' => view('dashboard.admin.appointments.partial.datatable_cols._patient',[
                'item' => $this
            ])->render(),
            'date' => view('dashboard.admin.appointments.partial.datatable_cols._date',[
                'item' => $this
            ])->render(),
            'status' => view('dashboard.admin.appointments.partial.datatable_cols._status',[
                'item' => $this
            ])->render(),
            'actions' => view('dashboard.admin.appointments.partial.datatable_cols._action',[
                'item' => $this
            ])->render(),
        ];
    }

}
