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
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('buy_details', function (Blueprint $table) {
            $table->unsignedInteger('buy_id');
            $table->foreign('buy_id')->references('id')->on('buys')->onDelete('restrict');
            $table->unsignedInteger('good_id');
            $table->foreign('good_id')->references('id')->on('goods')->onDelete('restrict');
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
