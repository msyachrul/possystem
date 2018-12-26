<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price',16,0);
            $table->decimal('qty',10,0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sale_details', function (Blueprint $table) {
            $table->string('sale_number');
            $table->foreign('sale_number')->references('number')->on('sales')->onDelete('restrict');
            $table->string('good_barcode');
            $table->foreign('good_barcode')->references('barcode')->on('goods')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
}
