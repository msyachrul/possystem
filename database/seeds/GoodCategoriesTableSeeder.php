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
        // factory(App\GoodCategory::class, 4)->create();

        $categories = ['Makanan', 'Minuman', 'Kosmetik', 'Lain-lain'];

        foreach ($categories as $key => $category) {
        	\App\GoodCategory::create(['name' => $category]);
        }
    }
}
