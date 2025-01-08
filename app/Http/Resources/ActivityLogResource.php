<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->subject){
            $subject_name = explode('\\', get_class($this->subject));
            $subject_name = $subject_name[count($subject_name)-1];
        }else{
            $subject_name = '--';
        }

        return [
            'log_name' => $this->log_name,
            'properties' => $this->convertProperties($this->properties)[0],
            'causer_name' => @$this->causer->name,
            'subject_id' => $this->subject_id,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'subject_name' => $subject_name,
            'actions' =>  view('dashboard.settings.activity_log.partial.datatable_cols._action',['item' => $this])->render()

        ];
    }

    public function convertProperties($data)
    {
//        $data = json_decode(json_encode($data), true);

        $result = collect([$data])->map(function ($item, $key) {
            $attributes = @$item['attributes'] ?? [];
            $old = @$item['old'] ?? [];

            $result = collect($attributes)->map(function ($value, $key) use ($old) {
                return [
                    'key' => $key,
                    'new' => $value,
                    'old' => @$old[$key]
                ];
            })->all();
            return array_values($result);
        })->all();
        return array_values($result);

    }

    public function getValue($data)
    {
        if (isset($data->value)) {
            return $data->value;
        } elseif (isset($data->id)) {
            return $data;
        } else {
            return null;
        }
    }


}
