<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('product_id');
            $table->bigInteger('color_id')->nullable();
            $table->bigInteger('quantity');
            $table->double('price',8,2);
            $table->double('total',8,2);
            $table->double('gst',8,2)->nullable();
            $table->bigInteger('shipping_address_id')->nullable();
            $table->char('status',1)->comment('1 = pending, 2 = shipped, 3 = delivered, 4 = Cancelled');
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
        Schema::dropIfExists('order_details');
    }
}
