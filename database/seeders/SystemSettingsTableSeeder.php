<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            [
                'title'         => 'Email Verification',
                'type'          => 'Register',
                'layout'        => '2',
                'key'           => 'email_verification',
                'value'         => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        SystemSetting::insert($setting);
    }
}
