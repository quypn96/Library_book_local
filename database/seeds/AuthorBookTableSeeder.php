<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorBookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $arr = [];
        for ($i = 0; $i < 30; $i++) {
            $a = [
                'author_id' => $faker->numberBetween($min = 1, $max = 10),
                'book_id' => $faker->numberBetween($min = 1, $max = 50),
            ];
            array_push($arr, $a);
        }

        DB::table('author_book')->insert($arr);
    }
}
