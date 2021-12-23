<?php

namespace Database\Seeders;

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
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'title'         => 'Book Expired Time (Day)',
                'type'          => 'Expired',
                'layout'        => '1',
                'key'           => 'book_expired_time',
                'value'         => 5,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ];

        SystemSetting::insert($setting);
    }
}
