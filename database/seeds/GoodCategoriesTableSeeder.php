<?php

use Illuminate\Database\Seeder;

class GoodCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GoodCategory::class, 10)->create();
    }
}
