<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\ContentManagement;

class ContentManagementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $array_contents = [];

        for ($i=0; $i <= 4; $i++) { 
            $content = [
                'title'         => 'Content'.($i+1),
                'description'   => $faker->paragraph,
                'status'        => rand(1, 2),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            array_push($array_contents, $content);
        }

        ContentManagement::insert($array_contents);
    }
}
