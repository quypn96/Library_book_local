<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'root',
            'parent_id' => 0,
            'status' => 1,
        ]);
        factory(App\Models\Category::class, 20)->create();
    }
}
