<?php

namespace App\Http\Resources\UserManagement\Doctors;

use App\Constants\Enum;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminDoctorResource extends JsonResource
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
            'id' => view('dashboard.admin.doctors.partial.datatable_cols._id',[
                'item' => $this
            ])->render(),
            'name' => view('dashboard.admin.doctors.partial.datatable_cols._name',[
                'item' => $this
            ])->render(),
            'status' => view('dashboard.admin.doctors.partial.datatable_cols._status',[
                'item' => $this
            ])->render(),
            'verify' => view('dashboard.admin.doctors.partial.datatable_cols._verify',[
                'item' => $this
            ])->render(),
            'actions' => view('dashboard.admin.doctors.partial.datatable_cols._action',[
                'item' => $this
            ])->render(),
            'phone' => $this->phone,
            'specialty' => @$this->doctorSpecialty->name,
        ];
    }

}
