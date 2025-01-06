<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["key" => 'site_name', "value" => 'booking'],
            ["key" => 'site_description', "value_ar" => 'booking'],
            ["key" => 'site_icon', "value" => 'icon_site.png'],
            ["key" => 'site_tags', "value" => ''],
            ["key" => 'about_image', "value" => 'about-01.png'],
            ["key" => 'about_title', "value" => 'Online shopping includes both buying things online.'],
            ["key" => 'about_sub_title', "value" => 'Salesforce B2C Commerce can help you create unified, intelligent digital commerce
                                experiences — both online and in the store.'],
            ["key" => 'about_description_left', "value" => 'SEmpower your sales teams with industry tailored
                                    solutions that support manufacturers as they go
                                    digital, and adapt to changing markets &amp; customers
                                    faster by creating new business.'],
            ["key" => 'about_description_right', "value" => 'Salesforce B2B Commerce offers buyers the
                                    seamless, self-service experience of online
                                    shopping with all the B2B'],
            ["key" => 'about_info_box1_title', "value" => '40,000+ Happy Customer'],
            ["key" => 'about_info_box1_content', "value" => 'Empower your sales teams with industry
                                tailored solutions that support.'],
            ["key" => 'about_info_box2_title', "value" => '40,000+ Happy Customer'],
            ["key" => 'about_info_box2_content', "value" => 'Empower your sales teams with industry
                                tailored solutions that support.'],
            ["key" => 'about_info_box3_title', "value" => '40,000+ Happy Customer'],
            ["key" => 'about_info_box3_content', "value" => 'Empower your sales teams with industry
                                tailored solutions that support.'],

        ];
        Setting::query()->insert($data);
    }
}
