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
            $table->bigIncrements('id');
            $table->string('name',256);
            $table->string('tag_name',500)->nullable();
            $table->string('size_wearing',500)->nullable();
            $table->string('fit_wearing',500)->nullable();
            $table->string('material',500)->nullable();
            $table->string('care',500)->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('seller_id');
            $table->bigInteger('category');
            $table->bigInteger('first_category');
            $table->bigInteger('second_category');
            $table->string('main_image',500)->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->char('status')->default(1)->comment('1 = Active, 2 = InActive');
            $table->softDeletes();
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
