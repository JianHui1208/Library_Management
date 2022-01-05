<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $array_category = [];

        for ($i=0; $i <= 15; $i++) { 
            $category = [
                'title'         => $faker->word,
                'description'   => $faker->paragraph,
                'status'        => rand(1, 2),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            array_push($array_category, $category);
        }

        BookCategory::insert($array_category);
    }
}
