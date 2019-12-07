<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(RatesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PublishersTableSeeder::class);
        $this->call(BookCategoryTableSeeder::class);
        $this->call(AuthorBookTableSeeder::class);

    }
}
