<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Sale;
use App\SaleDetail;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i <= 100; $i++) { 
        	$price = $faker->numberBetween($min = 14000, $max = 15000);
        	$qty = $faker->numberBetween($min = 1, $max = 10);
        	$total = $price * $qty;

        	$buy = Sale::create([
        		'number' => '012019' . $faker->date($format = 'md', $max = 'now') . sprintf('%04d',$i),
        		'total' => $total,
        	])->saleDetails()->create([
        		'good_barcode' => $faker->randomElement($array = ['010001', '010002', '010003', '010004', '010005']),
        		'price' => $price,
        		'qty' => $qty,
        	]);
        }
    }
}
