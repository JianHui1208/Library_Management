<?php

namespace Database\Seeders;

use App\Models\BookTag;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BookTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $booktags = [];

        for ($i=0; $i < 80; $i++) { 
            $tag = [
                'title'             => $faker->word,
                'status'            => rand(1,2),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            array_push($booktags, $tag);
        }

        BookTag::insert($booktags);
    }
}
