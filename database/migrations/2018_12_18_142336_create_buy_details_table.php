<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cost',16,0);
            $table->decimal('qty',10,0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('buy_details', function (Blueprint $table) {
            $table->string('buy_number');
            $table->foreign('buy_number')->references('number')->on('buys')->onDelete('restrict');
            $table->string('good_barcode');
            $table->foreign('good_barcode')->references('barcode')->on('goods')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buy_details');
    }
}
