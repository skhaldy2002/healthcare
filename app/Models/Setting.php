<?php

namespace App\Models;

use App\Traits\SystemLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory,SystemLog;

    const FILLABLE = ['key','value'];

    protected $fillable = self::FILLABLE;


    public function getValueAttribute($value)
    {
        if($this->key == 'site_icon'){
            if ($value == 'icon_site.png') {
                return asset('assets/media/icons/icon_site.png');
            }
            return asset('storage/site-icons/' . $value);
        }elseif($this->key == 'about_image'){
            if ($value == 'about-01.png') {
                return asset('website/assets/images/about/about-01.png');
            }
            return asset('storage/site-icons/' . $value);
        }elseif($this->key == 'site_tags'){
            return json_encode(convertTagsStringToObject($value));
        }else{
            return $value;
        }

    }

}
