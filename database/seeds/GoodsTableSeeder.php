<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goods = [
        	[
        		'barcode' => '010001',
        		'name' => 'Keripik',
        		'cost' => 8900,
        		'price' => 15000,
        		'good_category_id' => 1, 
        		'vendor_id' => 3,
        	],
        	[
        		'barcode' => '010002',
        		'name' => 'Mie Lidi',
        		'cost' => 8100,
        		'price' => 15000,
        		'good_category_id' => 1, 
        		'vendor_id' => 6,
        	],
        	[
        		'barcode' => '010003',
        		'name' => 'Seblak',
        		'cost' => 7000,
        		'price' => 15000,
        		'good_category_id' => 1, 
        		'vendor_id' => 2,
        	],
        ];

        foreach ($goods as $key => $good) {
        	\App\Good::create($good);
        }
    }
}
