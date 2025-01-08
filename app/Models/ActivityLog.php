<?php

namespace App\Models;


use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{


    public function scopeFilter($q)
    {
        // special for filter dashboard -- start
        $searchParams = [];
        if(request('search') && !is_null(request('search')['value'])){
            $searchParams = json_decode(request('search')['value'], true);
        }

        foreach ($searchParams as $column => $value) {
            if ($value !== '') {
                switch ($column) {
                    case 'subject_id':
                        $q->where('subject_id',$value);
                        break;
                    case 'subject_type':
                        $q->where('subject_type', $value);
                        break;
                    // Add additional cases for other columns if needed
                }
            }
        }
        // special for filter dashboard -- end
        return $q;
    }

    public function getSubjectType($arr, $subject_type)
    {
        foreach ($arr as $key => $value) {
            if ($key == $subject_type)
                return $value;
        }
        return null;
    }
}
