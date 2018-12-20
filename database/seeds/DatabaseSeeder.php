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
        // $this->call(UsersTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(GoodCategoriesTableSeeder::class);
        // $this->call(GoodsTableSeeder::class);
    }
}
