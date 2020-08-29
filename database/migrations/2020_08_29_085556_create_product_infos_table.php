<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();

          $table->bigInteger('product_id')->unsigned()->index();
          $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
          $table->string('color', 50);
          $table->string('size', 50);
          $table->integer("quantity");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_infos');
    }
}
