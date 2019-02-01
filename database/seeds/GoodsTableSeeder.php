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
        		'name' => 'Keripik Singkong',
                'qty' => 10,
        		'cost' => 7100,
        		'price' => 15000,
        		'good_category_id' => 1, 
        	],
        	[
        		'barcode' => '010002',
        		'name' => 'Mie Lidi',
                'qty' => 10,
        		'cost' => 8100,
        		'price' => 15000,
        		'good_category_id' => 1, 
        	],
        	[
        		'barcode' => '010003',
        		'name' => 'Seblak',
                'qty' => 10,
        		'cost' => 7000,
        		'price' => 15000,
        		'good_category_id' => 1, 
        	],
            [
                'barcode' => '010004',
                'name' => 'Keripik Keong',
                'qty' => 10,
                'cost' => 7600,
                'price' => 15000,
                'good_category_id' => 1,   
            ],
            [
                'barcode' => '010005',
                'name' => 'Keripik Kaca',
                'qty' => 10,
                'cost' => 7800,
                'price' => 15000,
                'good_category_id' => 1,   
            ],
        ];

        foreach ($goods as $key => $good) {
        	\App\Good::create($good);
        }
    }
}
