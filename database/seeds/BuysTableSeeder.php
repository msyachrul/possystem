<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Buy;
use App\BuyDetails;

class BuysTableSeeder extends Seeder
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
        	$vendor_id = $faker->numberBetween($min = 1, $max = 10);
        	$good_barcode = $faker->randomElement($array = ['010001', '010002', '010003', '010004', '010005']);
        	$cost = $faker->numberBetween($min = 7000, $max = 8000);
        	$qty = $faker->numberBetween($min = 1, $max = 10);
        	$total = $cost * $qty;

        	$buy = Buy::create([
        		'number' => '02' . $faker->date($format = 'Ymd', $max = 'now') . sprintf('%04d',$i),
        		'total' => $total,
        		'vendor_id' => $vendor_id
        	])->buyDetails()->create([
        		'good_barcode' => $good_barcode,
        		'cost' => $cost,
        		'qty' => $qty,
        	]);
        }
    }
}
