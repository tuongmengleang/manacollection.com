<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

          $table->bigInteger('product_category_id')->unsigned()->index();
          $table->foreign('product_category_id')
            ->references('id')
            ->on('product_categories')
            ->onDelete('cascade');

          $table->bigInteger('product_subcategory_id')->unsigned()->index();
          $table->foreign('product_subcategory_id')
            ->references('id')
            ->on('product_subcategories')
            ->onDelete('cascade');

          $table->bigInteger('brand_id')->unsigned()->index();
          $table->foreign('brand_id')
            ->references('id')
            ->on('brands')
            ->onDelete('cascade');

          $table->string('code',155);
          $table->string('name',255)->nullable();
          $table->double('cost_price',8,2);
          $table->double('sale_price',8,2);
          $table->tinyInteger('discount')->nullable();
          $table->integer('discount_amount')->nullable();
          $table->text('remark')->nullable();
          $table->tinyInteger('status');
          $table->string('video_link',255)->nullable();

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
        Schema::dropIfExists('products');
    }
}
