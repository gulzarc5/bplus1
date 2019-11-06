<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('seller_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id');
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('pin')->nullable();
            $table->string('gst')->nullable();
            $table->string('pan')->nullable();
            $table->date('dob')->nullable();
            $table->char('gender')->comment("M = Male, F = Female")->nullable();
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
        Schema::dropIfExists('seller_details');
    }
}
