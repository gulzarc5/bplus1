<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_map', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('color_id')->nullable();
            $table->bigInteger('category')->nullable();
            $table->bigInteger('first_category')->nullable();
            $table->bigInteger('second_category')->nullable();
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
        Schema::dropIfExists('color_map');
    }
}
