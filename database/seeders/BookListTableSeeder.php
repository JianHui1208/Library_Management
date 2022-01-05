<?php

namespace Database\Seeders;

use App\Models\BookTag;
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

        for ($i=0; $i < 50; $i++) { 
            $list = [
                'uid'               => BookList::generateUID(),
                'title'             => $faker->word,
                'description'       => $faker->text($maxNbChars = 500),
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

        $bookTag = BookTag::get('id')->toArray();
        $min = min($bookTag);
        $max = max($bookTag);

        $bookLists = BookList::all();
        foreach ($bookLists as $bookList) {
            $random_number_array = range($min['id'], $max['id']);
            shuffle($random_number_array);
            $random_number_array = array_slice($random_number_array ,rand(1,4), rand(2,5));

            $bookList->book_tags()->sync($random_number_array);
        }
    }
}
