<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('photo')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->string('ages')->nullable();;
            $table->string('specification')->nullable();;
            $table->text('english_name')->nullable();;
            $table->text('precautions')->nullable();;
            $table->text('instructions')->nullable();;
            $table->text('ingredients')->nullable();;
            $table->text('photo_url')->nullable();;
            $table->text('page_url')->nullable();;



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