<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewSaleTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW view_sale_transactions as SELECT 
                sale_details.sale_number as `number`,
                CONCAT(goods.barcode, " - ",goods.name) as `name`,
                goods.cost as `cost`,
                sale_details.price as `price`,
                sale_details.qty as `qty`,
                goods.cost * sale_details.qty as `cost_total`,
                sale_details.price * sale_details.qty as `price_total`,
                (sale_details.price * sale_details.qty) - (goods.cost * sale_details.qty) as `profit_total` 
            FROM sale_details JOIN goods ON sale_details.good_barcode = goods.barcode');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW view_sale_transactions');
    }
}
