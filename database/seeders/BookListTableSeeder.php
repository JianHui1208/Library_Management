<?php

namespace Database\Seeders;

use App\Models\BookList;
use App\Models\BookCategory;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BookListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $category = BookCategory::get('id')->toArray();
        $min = min($category);
        $max = max($category);

        $booklist = [];

        for ($i=0; $i < 40; $i++) { 
            $list = [
                'uid'               => BookList::generateUID(),
                'title'             => $faker->name,
                'book_category_id'  => rand($min['id'], $max['id']),
                'language'          => rand(1,3),
                'year'              => rand(1990, 2022),
                'status'            => rand(1,4),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            array_push($booklist, $list);
        }

        BookList::insert($booklist);
    }
}
