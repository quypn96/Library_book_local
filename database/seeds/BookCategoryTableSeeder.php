<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCategoryTableSeeder extends Seeder
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
        for ($i = 0; $i < 50; $i++) {
            $a = [
                'cate_id' => $faker->numberBetween($min = 1, $max = 10),
                'book_id' => $faker->numberBetween($min = 1, $max = 30),
            ];
            array_push($arr, $a);
        }

        DB::table('book_category')->insert($arr);

    }
}
