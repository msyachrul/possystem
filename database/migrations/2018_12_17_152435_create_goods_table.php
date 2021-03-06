<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode',9)->unique();
            $table->string('name',50);
            $table->decimal('qty',10,0)->default(0);
            $table->decimal('cost',16,0)->default(0);
            $table->decimal('price',16,0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->unsignedInteger('good_category_id');
            $table->foreign('good_category_id')->references('id')->on('good_categories')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
